<?php

namespace App\Services;

use App\Repositories\AstroRepository;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerService
{

    protected $astroRepository = null;

    public function __construct(AstroRepository $astroRepository)
    {
        $this->astroRepository = $astroRepository;
    }

    public function astroCrawler()
    {
        $client = new Client();
        for ($i = 0; $i < 12; $i++) {
            $astroContent = ['date' => date('Y-m-d')];
            $content = $client->get('https://astro.click108.com.tw/daily_' . $i . '.php?iAstro=' . $i . '&iAcDay=' . date('Y-m-d'))->getBody()->getContents();
            $crawler = new Crawler();
            $crawler->addHtmlContent($content);
            // 取得星座名稱
            $titleValues = $crawler->filterXPath('//*[@class="TODAY_CONTENT"]/h3')->text();
            $astroContent['astro_name'] = preg_replace('/[今日|解析]/u', '', $titleValues);
            // 取得各種運勢評分及說明
            $imageValues = $crawler->filterXPath('//*[@class="STAR_LIGHT"]/img')->each(function (Crawler $node, $i) {
                return $node->attr('src');
            });
            $contentValues = $crawler->filterXPath('//*[@class="TODAY_CONTENT"]/p')->each(function (Crawler $node, $i) {
                return $node->text();
            });
            // 總共有四種運勢要處理，使用for迴圈執行四次
            for ($j = 0; $j < 4; $j++) {
                $imgContent = explode('/', $imageValues[$j]);
                $astroContent['type'] = $imgContent[7];
                $astroContent['score'] = (int) preg_replace('/[icon0|.png]/', '', $imgContent[8]);
                $astroContent['img_url'] = $imageValues[$j];
                $astroContent['score_text'] = $contentValues[2 * $j];
                $astroContent['content'] = $contentValues[2 * $j + 1];
                $this->astroRepository->createAstro($astroContent);
            }
        }
    }
}
