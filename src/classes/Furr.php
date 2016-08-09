<?php
/**
 * Created by PhpStorm.
 * User: S
 * Date: 09.08.2016
 * Time: 9:02
 */

namespace Apo100l\Quest;

class Furr extends QuestAbstract
{
  
    public function Sumco($arguments = array()){

        echo 'Please enter start date: ';
        $start_date = fgets(STDIN);
        echo 'Please enter end date: ';
        $end_date = fgets(STDIN);

//        $start_date = date("Y-m-d H:i:s", strtotime('2015-10-01'));
//        $end_date = date("Y-m-d H:i:s", strtotime('2015-10-15'));

        $start_date = '2015-07-20';
        $end_date = '2015-11-01';

        echo '+--------+-----------------+' . "\n";
        echo '|  count |          amount |' . "\n";
        echo '+--------+-----------------+' . "\n";

        foreach($arguments as $arg){

            switch($arg){
                case '--without-documents':
                    $q = 'SELECT COUNT(payments.id) AS p_count,
                            SUM(payments.amount) AS sum
                            FROM payments LEFT JOIN documents ON payments.id=documents.entity_id
                            WHERE payments.create_ts BETWEEN "' . $start_date . '" AND "' . $end_date
                        . '" AND documents.entity_id IS NULL';

                    break;
                case '--with-documents':
                    $q = 'SELECT COUNT(payments.id) AS p_count,
                    SUM(payments.amount) AS sum
                    FROM payments JOIN documents ON documents.entity_id=payments.id 
                    WHERE payments.create_ts BETWEEN "' . $start_date . '" AND "' . $end_date . '"';
                    break;
                case '':
                    $q='';
            }

            if($q != ''){

                foreach (self::getDb()->query($q) as $row){

                    echo '| ' . str_pad($row['p_count'], 6, " ", STR_PAD_LEFT) .' | ' . str_pad($row['sum'], 15, " ", STR_PAD_LEFT) . ' | ' . "\n";

                }
                echo '+--------+-----------------+' . "\n";
            }
        }
    }
}