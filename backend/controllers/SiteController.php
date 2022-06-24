<?php

namespace app\controllers;


use app\models\companies\transport\TransportCompaniesBy;
use app\models\media\ArrayMedia;
use app\models\media\tables\Table;
use app\models\media\tables\TablePackages;
use app\models\media\tables\TableTransportCompanies;
use app\models\ObjectCollectionByRow;
use app\models\ObjectsCollectionByQuery;
use app\models\packages\FastPackage;
use app\models\packages\PackageBy;
use app\models\packages\SlowPackage;
use app\models\packages\WithTransportCompanies;
use yii\rest\Controller;

class SiteController extends Controller
{
    /**
     * Создает "быструю" посылку
     */
    public function actionCreateFastPackage()
    {
        $package = new FastPackage(
            'source',
            'target',
            25
        );
        $package->printTo(
            new TablePackages()
        );
        return $package->printTo(
            new ArrayMedia()
        );
    }

    /**
     *  Создает "медленную" посылку
     */
    public function actionCreateSlowPackage()
    {
        $package = new SlowPackage('source', 'target', 25);
        $package->printTo(
            new TablePackages()
        );
        return $package->printTo(
            new ArrayMedia()
        );
    }

    /**
     * Отображает стоимость одной посылки по разным ТК
     */
    public function actionShowShippingCost()
    {
        $package = new WithTransportCompanies(
            new PackageBy(
                TablePackages::find()->where(['id' => 1])
            ),

        );
        return $package->printTo(
            new ArrayMedia()
        );
    }

    /**
     * Отображает стоимость всех посылок, по ТК
     */
    public function actionSwohAllShippingCost()
    {
        $collection =
            new ObjectsCollectionByQuery(
                TablePackages::find(), //Условие для поиска
                'packages', //тип объекта (это не фабрика)
                function (TablePackages $package) { //указываем пример создания объекта для коллекции
                    return new WithTransportCompanies(
                        new FastPackage(
                            $package->source_kladr,
                            $package->target_kladr,
                            $package->weight
                        ),
                        new ObjectCollectionByRow(
                            $package->companies,
                            'companies',
                            function(TableTransportCompanies $transportCompany){
                                return new TransportCompaniesBy();
                            }
                        )
                    );
                }
            );
        return $collection->printTo(
            new ArrayMedia()
        );
    }
}
