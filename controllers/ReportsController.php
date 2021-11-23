<?php

use models\Reports;

class ReportsController
{
    public function actionIndex()
    {
        $reportList = [];
        $reportList = (new Reports())->getReportsList();
        require_once(ROOT . '/views/reports/index.php');
        return true;
    }

}