<?php
namespace Snowdog\Menu\Ui\Component\Listing\Column\MenuList;

use Magento\Ui\Component\Listing\Columns\Column;

class PageActions extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            foreach ($dataSource["data"]["items"] as & $item) {
                $name = $this->getData("name");
                $id = "X";

                if (isset($item["menu_id"])) {
                    $id = $item["menu_id"];
                }

                $item[$name]["view"] = $this->getEditAction($id);
                $item[$name]["export"] = $this->getExportAction($id);
            }
        }

        return $dataSource;
    }

    /**
     * @param int $id
     * @return array
     */
    private function getEditAction(int $id): array
    {
        return [
            "href" => $this->getContext()->getUrl(
                "snowmenu/menu/edit",
                ["id" => $id]
            ),
            "label" => __("Edit"),
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    private function getExportAction(int $id): array
    {
        return [
            "href" => $this->getContext()->getUrl(
                "snowmenu/menu/export",
                ["id" => $id]
            ),
            "label" => __("Export"),
        ];
    }
}
