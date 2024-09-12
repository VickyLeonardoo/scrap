<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Symfony\Component\DomCrawler\Crawler;

class ComparisonController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return view('comparison.index', compact('shops'));
    }

    public function compare(Request $request)
    {
        $validated = $request->validate([
            'shop1_id' => 'required|exists:shops,id',
            'shop2_url' => 'required|url',
            'keyword' => 'required|string',
            'page1' => 'sometimes|integer|min:1',
            'page2' => 'sometimes|integer|min:1',
            'sort' => 'sometimes|string',
        ]);

        $shop1 = Shop::findOrFail($validated['shop1_id']);
        $shop1_url = $shop1->link;

        $sort = $validated['sort'] ?? '23';
        $shop1_search_url = $this->buildSearchUrl($shop1_url, $validated['keyword'], $validated['page1'] ?? 1, $sort);
        $shop2_search_url = $this->buildSearchUrl($validated['shop2_url'], $validated['keyword'], $validated['page2'] ?? 1, $sort);

        $shop1_data = $this->fetchData($shop1_search_url);
        $shop2_data = $this->fetchData($shop2_search_url);

        $shop1_data['current_page'] = $validated['page1'] ?? 1;
        $shop2_data['current_page'] = $validated['page2'] ?? 1;
        $current_sort = $sort;

        return view('comparison.result', compact('shop1_data', 'shop2_data', 'current_sort', 'shop1', 'shop1_url'));
    }

    private function buildSearchUrl($shop_url, $keyword, $page, $sort)
    {
        $parsed_url = parse_url($shop_url);
        $shop_name = explode('/', trim($parsed_url['path'], '/'))[0];
        
        // Check if the shop has a "Beranda" page
        $has_beranda = $this->checkForBeranda($shop_url);
        
        $page_segment = $page > 1 ? "page/{$page}" : "";
        $product_segment = $has_beranda ? "product/" : "";
        
        return "https://www.tokopedia.com/{$shop_name}/{$product_segment}{$page_segment}?q=" . urlencode($keyword) . "&sort={$sort}";
    }

    private function checkForBeranda($shop_url)
    {
        $html = $this->getHtmlContent($shop_url);
        $crawler = new Crawler($html);
        
        $beranda_button = $crawler->filter('[data-testid="Beranda"]');
        return $beranda_button->count() > 0;
    }

    private function fetchData($url)
    {
        $html = $this->getHtmlContent($url);
        $crawler = new Crawler($html);

        return [
            'products' => $this->extractProducts($crawler),
            'shop_name' => $this->extractShopName($crawler),
            'next_page' => $this->extractPageLink($crawler, 'btnShopProductPageNext'),
            'prev_page' => $this->extractPageLink($crawler, 'btnShopProductPagePrevious'),
        ];
    }

    private function getHtmlContent($url)
    {
        return Browsershot::url($url)
            ->windowSize(1920, 1080)
            ->addChromiumArguments(['--disable-http2'])
            ->userAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36')
            ->timeout(30000)
            ->bodyHtml();
    }

    private function extractProducts(Crawler $crawler)
    {
        $products = [];
        $crawler->filter('.css-54k5sq')->each(function (Crawler $node) use (&$products) {
            if (count($products) >= 80) {
                return false;
            }

            $products[] = [
                'title' => $node->filter('.prd_link-product-name')->text('N/A'),
                'price' => $node->filter('.prd_link-product-price')->text('N/A'),
                'image' => $node->filter('.css-1q90pod')->attr('src'),
                'link' => $node->filter('a')->attr('href'),
                'rating' => $node->filter('.prd_rating-average-text')->text('Belum ada rating'),
                'sold' => $node->filter('.prd_label-integrity')->text('Belum terjual'),
            ];
        });

        return $products;
    }

    private function extractShopName(Crawler $crawler)
    {
        return $crawler->filter('.css-fzzhh3[data-testid="shopNameHeader"]')->text('Nama Toko');
    }

    private function extractPageLink(Crawler $crawler, $buttonTestId)
    {
        try {
            $link = $crawler->filter("[data-testid=\"{$buttonTestId}\"]")->attr('href');
            return $link ? "https://www.tokopedia.com" . $link : null;
        } catch (\InvalidArgumentException $e) {
            // If the element is not found, return null
            return null;
        }
    }
}