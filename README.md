# Тестовое задание для HR365.ru

Задачей было разработать небольшой модуль,
который бы работал с апи транспортных компаний, и по запросу 
выгружал стоимость доставки груза определенной массы. 

Информацию необходимо было предоставить списоком транспортных компаний с соответствующей 
стоимостью.

Особенности: нужно было сделать "безболезненное" добавление 
последующих ТК в рабочий код.

### Решение
В основном использовались такие паттерны как декоратор, 
фабрика/фабричный метод. 

Чтобы запустить модуль в своей среде необходимо:

1. Установить Docker-compose
2. Перейти в дирректорию docker
3. Создать файл .env (можно скопирвоать из образца)
4. Добавить в hosts файл домен указанный в .env файле, связать его с  ип `127.0.0.1`
4. Запустить `docker-compose up -d`

После установки всех зависимостей модуль будет доступен по указанному вами домену, 
у меня это `hr365.my:83`

миграции и пр. применятся автоматически.
