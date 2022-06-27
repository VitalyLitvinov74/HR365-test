<?php

namespace app\controllers;


use app\models\companies\transport\Boxberry;
use app\models\companies\transport\CDEK;
use app\models\companies\transport\contracts\TransportCompaniesFactory;
use app\models\companies\transport\TransportCompaniesBy;
use app\models\media\ArrayMedia;
use app\models\media\tables\Table;
use app\models\media\tables\TablePackages;
use app\models\media\tables\TableTransportCompanies;
use app\models\media\WithError;
use app\models\ObjectCollectionByRow;
use app\models\ObjectsCollection;
use app\models\ObjectsCollectionByQuery;
use app\models\packages\DefaultPackage;
use app\models\packages\FastPackage;
use app\models\packages\Package;
use app\models\packages\PackageBefored;
use app\models\packages\PackageBy;
use app\models\packages\SlowPackage;
use app\models\packages\WithPrintedFastCost;
use app\models\packages\WithPrintedSlowCost;
use Symfony\Component\Yaml\Tests\B;
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
                    new Package(
                        '7700000000000', //москва
                        '7400000100000', //челябинск
                        rand(2500, 15000)
                    )
                ),
                "18:00"
            );
        return $package
            ->printTo(new TablePackages())
            ->commit()
            ->attributesList();
    }

    /**
     *  Создает "медленную" посылку
     */
    public function actionCreateSlowPackage()
    {
        $package = new SlowPackage(
            new Package(
                '7700000000000', //москва
                '7400000100000', //челябинск
                rand(2500, 15000)
            )
        );
        return $package
            ->printTo(new TablePackages())
            ->commit()
            ->attributesList();
    }

    /**
     * Отображает стоимость всех посылок, по ТК
     */
    public function actionShowAllShippingCost()
    {
        $collection =
            new ObjectsCollectionByQuery(
                TablePackages::find(),
                'packages', //тип объекта (это не фабрика)
                //указываем пример создания объекта для коллекции, это фабричный метод
                function (TablePackages $package) {
                    $packageObj = new Package( //создаем дефолтный объект
                        $package->source_kladr,
                        $package->target_kladr,
                        $package->weight
                    );
                    $factory = new TransportCompaniesFactory();
                    if ($package->type == 'slow') {
                        return new WithError ( //Добавляем обработку ошибок
                            new WithPrintedSlowCost( //С распечатанной стоимостью
                                new SlowPackage( //сделанная как медленное отправление
                                    $packageObj //дефолтная посылка
                                ),
                                $factory
                            )
                        );
                    }
                    return
                        new WithError(
                            new WithPrintedFastCost( //с распечатанной стоимостью
                                new FastPackage( //сделанная как быстрое отправление
                                    $packageObj // дефолтная посылка
                                ),
                                $factory
                            )
                        );
                }
            );
        return $collection
            ->printTo(new ArrayMedia())
            ->attributesList();
    }

    /**
     * Возращает стоимость всех посылок, в одной транспортной компании
     */
    public function actionShowShippingCost(string $needleCompany)
    {
        $collection =
            new ObjectsCollectionByQuery(
                TablePackages::find(),
                'packages', //тип объекта (это не фабрика)
                //указываем пример создания объекта для коллекции, это фабричный метод
                function (TablePackages $package) use ($needleCompany) {
                    $packageObj = new Package( //создаем дефолтный объект
                        $package->source_kladr,
                        $package->target_kladr,
                        $package->weight
                    );
                    $factory = new TransportCompaniesFactory([
                        $needleCompany
                    ]);
                    if ($package->type == 'slow') {
                        return
                            new WithError( //Добавляем обработку ошибок
                                new WithPrintedSlowCost( //С распечатанной стоимостью
                                    new SlowPackage( //сделанная как медленное отправление
                                        $packageObj //дефолтная посылка
                                    ),
                                    $factory
                                )
                            );
                    }
                    return
                        new WithError( //добавляем обработку ошибок
                            new WithPrintedFastCost( //с распечатанной стоимостью
                                new FastPackage( //сделанная как быстрое отправление
                                    $packageObj // дефолтная посылка
                                ),
                                $factory
                            )
                        );
                }
            );
        return $collection
            ->printTo(new ArrayMedia())
            ->attributesList();
    }
}
