<?php
namespace models;
use components\Db;
use PDO;

class Reports
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = Db::getConnection();
    }

    public function getReportsList()
    {
        $sql = <<<SQL
    with sum_budget as(
        select project_id, sum(gross) as budget
        from main.employees e2
        where is_delete = 0
        group by project_id
    )
    select p.id, p.name, sb.budget
    from main.projects p
    left join sum_budget sb on p.id = sb.project_id
    group by p.id, p.name, sb.budget
    order by budget desc nulls last
SQL;

        $sql = $this->dbConnection->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
}