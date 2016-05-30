<?php

/**
 * GFConf_BlockManagerEnhanced
 *
 * @author Anselm Christophersen <ac@anselm.dk>
 * @date   May 2016
 */
class GFConf_BlockManagerEnhanced extends GridFieldConfig_BlockManager
{

    public function __construct($canAdd = true, $canEdit = true, $canDelete = true, $editableRows = false, $aboveOrBelow = false)
    {
        parent::__construct();

        $controllerClass = Controller::curr()->class;
        // Get available Areas (for page) or all in case of ModelAdmin
        if ($controllerClass == 'CMSPageEditController') {
            $currentPage = Controller::curr()->currentPage();
            $areasFieldSource = $this->blockManager->getAreasForPageType($currentPage->ClassName);
        } else {
            $areasFieldSource = $this->blockManager->getAreasForTheme();
        }

        $this->addComponent(new GridFieldGroupable(
            'BlockArea',    // The fieldname to set the Group
            'Area',   // A description of the function of the group
            'none',         // A title/header for items without a group/unassigned
            $areasFieldSource
        ));
    }
}
