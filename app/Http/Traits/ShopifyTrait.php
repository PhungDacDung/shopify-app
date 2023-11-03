<?php 
namespace App\http\Traits;
trait ShopifyTrait{


    public function getThemeIdActive($shop)
    {
        $themeActive = $shop->api()->rest('GET','/admin/api/2023-04/themes.json');
        if ($themeActive['errors'] == true || $themeActive['errors'] == "true") {
            return false;
        }
        $themeActive = $themeActive['body']['container']['themes'];
        $themeActiveId = false;
        foreach ($themeActive as $keyTheme => $valueTheme) {
            if ($valueTheme['role'] == 'main') {
                $themeActiveId = $valueTheme['id'];
                break;
            }
        }
        return $themeActiveId;
    }


    public function updateFileThemeLiquidShopify($shop, $themeActiveId, $fileLayout)
    {
        
        $params = ['asset[key]' => $fileLayout];
        $bodyThemeLiquid = $shop->api()->rest('GET', "/admin/api/2023-04/themes/$themeActiveId/assets.json", $params);
        if ($bodyThemeLiquid['errors'] != false) {
            return false;
        }
        $bodyThemeLiquid = $bodyThemeLiquid['body']['container']['asset']['value'];

        if(!strpos($bodyThemeLiquid,"{% include 'popup_notify' %}")){
            $bodyThemeLiquid = $bodyThemeLiquid . $importCodeLiquid = "{% include 'popup_notify' %}";
        }

        $postField = [
            'asset' => [
                'key' => $fileLayout,
                'value' => $bodyThemeLiquid,
            ],
        ];
        $updateFileLiquid = $shop->api()->rest('PUT', "/admin/api/2023-01/themes/$themeActiveId/assets.json", $postField);

        if ($updateFileLiquid['errors'] != false) {
            return false;
        }
        return true;
    }

    public function storeFileLiquidToShopify($shop, $themeActiveId, $data)
    {
        $postField = [
            'asset' => [
                'key' => 'snippets/popup_notify.liquid',
                'value' => $data,
            ],
        ];

        $updateFileStyle = $shop->api()->rest('PUT', '/admin/api/2023-01/themes/' . $themeActiveId . '/assets.json', $postField);
        if ($updateFileStyle['errors'] != false) {
            return false;
        }
        return true;
    }


    public function deletecursorNotifyToshopfy($shop, $themeActiveId)
    {

        $postField = [
            'asset' => [
                'key' => 'snippets/popup_notify.liquid',
            ],
        ];
        
        $deleteFileLiquid = $shop->api()->rest('DELETE', '/admin/themes/' . $themeActiveId . '/assets.json', $postField);
        if ($deleteFileLiquid['errors'] != false) {
            return false;
        }
        return true;
        
    }

    public function deleteUpdateFileThemLiquid($shop, $themeActiveId, $fileLayout)
    {
        $params = ['asset[key]' => $fileLayout];
        $bodyThemeLiquid = $shop->api()->rest('GET', "/admin/api/2023-04/themes/$themeActiveId/assets.json", $params);
        if ($bodyThemeLiquid['errors'] != false) {
            return false;
        }
        $bodyThemeLiquid = $bodyThemeLiquid['body']['container']['asset']['value'];

        $bodyThemeLiquid = str_replace("{% include 'popup_notify' %}", " ", $bodyThemeLiquid);

        $postField = [
            'asset' => [
                'key' => $fileLayout,
                'value' => $bodyThemeLiquid,
            ],
        ];
        $updateFileLiquid = $shop->api()->rest('PUT', "/admin/api/2023-01/themes/$themeActiveId/assets.json", $postField);
        if ($updateFileLiquid['errors'] != false) {
            return false;
        }
        return true;
    }

}
