<?php

namespace app\controllers;


use app\models\companies\transport\Boxberry;
use app\models\companies\transport\SDEK;
use app\models\companies\transport\TransportCompaniesBy;
use app\models\media\ArrayMedia;
use app\models\media\tables\Table;
use app\models\media\tables\TablePackages;
use app\models\media\tables\TableTransportCompanies;
use app\models\ObjectCollectionByRow;
use app\models\ObjectsCollection;
use app\models\ObjectsCollectionByQuery;
use app\models\packages\DefaultPackage;
use app\models\packages\FastPackage;
use app\models\packages\PackageBefored;
use app\models\packages\PackageBy;
use app\models\packages\SlowPackage;
use app\models\packages\WithTransportCompanies;
use yii\helpers\VarDumper;
use yii\rest\Controller;

class SiteController extends Controller
{
    /**
     * Создает "быструю" посылку
     */
    public function actionCreateFastPackage()
    {
        $package =
            new PackageBefored(
                new FastPackage(
                    '7700000000000', //москва
                    '7400000100000', //челябинск
                    rand(2500, 15000)
                ),
                "18:00"
            );
        return $package
            ->printTo(new TablePackages())
            ->attributesList();
    }

    /**
     *  Создает "медленную" посылку
     */
    public function actionCreateSlowPackage()
    {
        $package = new SlowPackage(
            '7700000000000', //москва
            '7400000100000', //челябинск
            rand(2500, 15000)
        );
        return $package
            ->printTo(new TablePackages())
            ->attributesList();
    }

    /**
     * Отображает стоимость всех посылок, по ТК
     */
    public function actionShowAllShippingCost()
    {
        $collection =
            new ObjectsCollectionByQuery(
                TablePackages::find(), //Условие для поиска, ленивый запрос
                'packages', //тип объекта (это не фабрика)
                function (TablePackages $package) { //указываем пример создания объекта для коллекции
//                    return new WithTransportCompanies(
//                        new DefaultPackage($package),
//                        $package->type,
//                        [
//                            new Boxberry(),
//                            new SDEK()
//                        ]
//                    );
                    return new DefaultPackage($package);
                }
            );
        return $collection
            ->printTo(new ArrayMedia())
            ->attributesList();
    }
}
