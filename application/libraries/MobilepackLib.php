<?php

/**
 * Description of Marketplace
 *
 * @author anton
 */
class MobilepackLib {

    const TABLENAMEORDPART = '[name]s';

    private $errorMessage;
    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->config->load('commonconfig');
    }

    public function getpackage($params) {
        $package['default'] = array(
            'hotel'        =>
            array(
                'version'   => '1',
                'id'        => '1',
                'latitude'  => '50.006488',
                'longitude' => '36.232781',
                'country'   => 'Ukraine',
                'languages' =>
                array(
                    'language' =>
                    array(
                        0 =>
                        array(
                            'language_id' => '1',
                            'name'        => 'Kharkiv Palace',
                        ),
                        1 =>
                        array(
                            'language_id' => '2',
                            'name'        => 'Харьков Палас',
                        ),
                    ),
                ),
                'modules'   =>
                array(
                    'module' =>
                    array(
                        0 =>
                        array(
                            'module_type_id'     => '1',
                            'module_instance_id' => '1',
                            'homescreen'         => 'true',
                            'icon_homescreen'    => 'http://icon_homescreen1.png',
                            'module_order'       => '7',
                            'languages'          =>
                            array(
                                'language' =>
                                array(
                                    0 =>
                                    array(
                                        'language_id' => '1',
                                        'name'        => 'Info',
                                    ),
                                    1 =>
                                    array(
                                        'language_id' => '2',
                                        'name'        => 'Информация',
                                    ),
                                ),
                            ),
                            'items'              =>
                            array(
                                'item' =>
                                array(
                                    'id'          => '1',
                                    'latitude'    => '50.006488',
                                    'longitude'   => '36.232781',
                                    'email'       => 'info@kharkiv-palace.com',
                                    'website_url' => 'http://kharkiv-palace.com',
                                    'languages'   =>
                                    array(
                                        'language' =>
                                        array(
                                            0 =>
                                            array(
                                                'language_id' => '1',
                                                'name'        => 'Kharkiv Palace',
                                                'address'     => '61000, Kharkiv, prosp. Pravdy 2',
                                                'description' => 'Welcome to the Kharkiv Palace Hotel the first five-star hotel in Ukraine to embody third-millennium luxury! This 11-storey building, built in typical Kharkiv-style constructivism, seamlessly unites with the architectural ensemble of the square. Its internal design combines the refinement of modern neo-classicism, functionality and the latest in building technologies. Included among the hotelís 180 rooms are the top-flight Presidential Suite and rooms of the Executive Floor.

The Kharkiv Palace Hotel is a member of the Premier Hotels management group ñ a collection of Ukrainian luxury hotels that offer signature personal touches while ensuring equally comfortable and hospitable accommodation. Most hotels are historic landmarks in their cities, each one with its own unique style, local accents and inimitable charm.',
                                            ),
                                            1 =>
                                            array(
                                                'language_id' => '2',
                                                'name'        => 'Харьков Палас',
                                                'address'     => '61000, Харьков, пр. Правды 2',
                                                'description' => '«Харьков Палас» - роскошь третьего тысячелетия.
К Вашим услугам:
аренда автомобилей и микроавтобуса;
басейн;
бизнес-центр (7:00- 23:00);
венская кофейня «Amadeus» (время работы: 8:00 - 22:00);
галерея бутиков;
интернет Wi-Fi бесплатно;
лобби-бар (круглосуточно);
магазин деликатесов «Березка» ( время работы: 8:00-22:00);
мини-бар;
обслуживание в номерах (круглосуточно);
организация конференций, банкетов;
охраняемый надземный и подземный паркинг;
панорамный ресторан Sky Lounge (время работы: 12:00 - 2:00);
услуги прачечной и химчистки;
представительский этаж;
президентские апартаменты;
ресторан тихоокеанской кухни «PacificSpoon» (время работы: 7:00 - 23:00);
гриль-ресторан «Терраса» (время работы: 11:00 - 23:00);
салон красоты;
финская сауна;
сейф в номере;
сейф на рецепции;
служба выездного обслуживания (кейтеринг);
служба дворецких (круглосуточно);
спа-центр;
спутниковое телевидение;
тренажерный зал;
услуги консьержа;
турецкий хаммам;',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        1 =>
                        array(
                            'module_type_id'     => '2',
                            'module_instance_id' => '2',
                            'homescreen'         => 'true',
                            'icon_homescreen'    => 'http://icon_homescreen2.png',
                            'module_order'       => '1',
                            'languages'          =>
                            array(
                                'language' =>
                                array(
                                    0 =>
                                    array(
                                        'language_id' => '1',
                                        'name'        => 'Rooms',
                                    ),
                                    1 =>
                                    array(
                                        'language_id' => '2',
                                        'name'        => 'Комнаты',
                                    ),
                                ),
                            ),
                            'items'              =>
                            array(
                                'item' =>
                                array(
                                    0 =>
                                    array(
                                        'id'        => '1',
                                        'price'     => '200',
                                        'icon_logo' => 'http://---/1.png',
                                        'languages' =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Classic Room',
                                                    'short_description' => 'Current Rate: 1600 UAH',
                                                    'room_type_name'    => 'Classic Room',
                                                    'description'       => 'This cozy space is decorated in warm, comforting tones and features lots of natural woods and soft fabrics. The room offers everything necessary for both working in comfort and relaxing, including a separate work area and a large bed. The room is ideal for either single or double occupancy.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'КЛАССИЧЕСКИЙ НОМЕР',
                                                    'short_description' => 'Текущая цена: 1600 UAH',
                                                    'room_type_name'    => 'КЛАССИЧЕСКИЙ НОМЕР',
                                                    'description'       => 'Уютный однокомнатный номер, оформленный в теплых естественных тонах с использованием натурального дерева и тканей. В номере есть все необходимое для комфортной работы и отдыха: полноценное рабочее место, широкая кровать. Номер идеально подходит как для одноместного так и двухместного размещения.',
                                                ),
                                            ),
                                        ),
                                    ),
                                    1 =>
                                    array(
                                        'id'        => '2',
                                        'price'     => '245',
                                        'icon_logo' => 'http://---/2.png',
                                        'languages' =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Premier',
                                                    'short_description' => 'Current Rate: 1990 UAH',
                                                    'room_type_name'    => 'Premier',
                                                    'description'       => 'A spacious room featuring a comfortable workspace and seating area, and designed in bright, warm colors and with generous use of natural materials. The room has a special atmosphere and boasts panoramic windows that offer spectacular views of the city.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Премьер',
                                                    'short_description' => 'Текущая цена: 1990 UAH',
                                                    'room_type_name'    => 'Премьер',
                                                    'description'       => 'Просторный однокомнатный номер c комфортной рабочей зоной и зоной отдыха. Интерьер номера выполнен в светлых, теплых тонах с использованием натуральных материалов. Особую атмосферу номера создают широкие панорамные окна, которые открывают великолепный вид на город.',
                                                ),
                                            ),
                                        ),
                                    ),
                                    2 =>
                                    array(
                                        'id'        => '3',
                                        'price'     => '370',
                                        'icon_logo' => 'http://---/3.png',
                                        'languages' =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Delux',
                                                    'short_description' => 'Current Rate: 2990 UAH',
                                                    'room_type_name'    => 'Delux',
                                                    'description'       => 'A spacious room with a gorgeous, brightly-colored interior. The room offers unimpeachable comfort and harmoniously combines areas for sleeping, working, and relaxing. The well-designed layout visually increases the room’s space, especially that part intended for entertaining guests or or otherwise enjoying a leisurely moment. The sleeping space, meanwhile, is designed for especial privacy. This room is the perfect choice for a business trip or for a family with children.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Делюкс',
                                                    'short_description' => 'Текущая цена: 2990 UAH',
                                                    'room_type_name'    => 'Делюкс',
                                                    'description'       => 'Просторный номер с великолепным интерьером, оформленным в светлых тонах. В номере очень удобно и гармонично объединены зоны для сна, работы и отдыха. Хорошо продуманная планировка визуально увеличивает пространство номера, особенно часть, предназначенную для приема гостей или отдыха, и создает особую приватность в зоне сна. Номер идеально подходит как для делового визита, так и для семьи с детьми.',
                                                ),
                                            ),
                                        ),
                                    ),
                                    3 =>
                                    array(
                                        'id'        => '4',
                                        'price'     => '450',
                                        'icon_logo' => 'http://---/4.png',
                                        'languages' =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Suite',
                                                    'short_description' => 'Current Rate: 3700 UAH',
                                                    'room_type_name'    => 'Suite',
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Люкс',
                                                    'short_description' => 'Текущая цена: 3700 UAH',
                                                    'room_type_name'    => 'Люкс',
                                                    'description'       => 'Роскошный двухкомнатный номер, состоящий из гостиной комнаты и спальни, с широкими окнами и панорамным видом на главную площадь города. Интерьер номера выполнен в теплых, сдержанных тонах, с использованием натуральных материалов: дерева и мрамора.
В гостиной комнате есть обеденный стол на 4 персоны, кофейный стол, удобные кресла и диван, большой современный телевизор. Спальня – просторная, с широкой кроватью, туалетным столиком, большим мягким креслом с торшером. К спальне примыкают отдельная ванная и гардеробная комната.',
                                                ),
                                            ),
                                        ),
                                    ),
                                    4 =>
                                    array(
                                        'id'        => '5',
                                        'price'     => '740',
                                        'icon_logo' => 'http://---/5.png',
                                        'languages' =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Presidential Apartments',
                                                    'short_description' => 'Current Rate: 6000 UAH',
                                                    'room_type_name'    => 'Presidential Apartments',
                                                    'description'       => 'Luxurious three-room suites with spacious living rooms and two bedrooms. All rooms offer stunning panoramic views of the city’s historic downtown. The living room is spacious and bright, with a panoramic corner window. It includes a dining table for six, a bar with a kitchenette, a comfortable sofa with a coffee table, a state of the art TV, and a workspace with a desk and comfortable armchair. Each bedroom is furnished with a king-size bed and large, comfortable chairs with footrests. Bedrooms have their own private bathrooms. The suite’s interior room, meanwhile, stands out for its contemporary and elegant style.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Президентские апартаменты',
                                                    'short_description' => 'Текущая цена: 6000 UAH',
                                                    'room_type_name'    => 'Президентские апартаменты',
                                                    'description'       => 'Роскошный трехкомнатный номер с просторной гостиной комнатой и двумя спальнями. Из всех комнат открывается прекрасный панорамный вид на исторический центр Харькова.  Гостиная комната просторная и светлая, с панорамным угловым окном. В ней есть обеденный стол на 6 персон, бар с мини-кухней, удобный диван с кофейным столом, современный телевизор; выделено место для работы - с письменным столом и удобным креслом. 
В каждой спальне – широкая кровать, большие, мягкие кресла с пуфами для ног. К спальнями примыкают отдельные ванные комнаты. 
Интерьер номера – современный и элегантный.',
                                                ),
                                            ),
                                        ),
                                    ),
                                    5 =>
                                    array(
                                        'id'      => '9',
                                        'deleted' => 'true',
                                    ),
                                    6 =>
                                    array(
                                        'id'      => '18',
                                        'deleted' => 'true',
                                    ),
                                ),
                            ),
                        ),
                        2 =>
                        array(
                            'module_type_id'     => '3',
                            'module_instance_id' => '3',
                            'homescreen'         => 'true',
                            'icon_homescreen'    => 'http://icon_homescreen3.png',
                            'module_order'       => '2',
                            'languages'          =>
                            array(
                                'language' =>
                                array(
                                    0 =>
                                    array(
                                        'language_id' => '1',
                                        'name'        => 'Facilities',
                                    ),
                                    1 =>
                                    array(
                                        'language_id' => '2',
                                        'name'        => 'Объекты',
                                    ),
                                ),
                            ),
                            'items'              =>
                            array(
                                'item' =>
                                array(
                                    0 =>
                                    array(
                                        'id'           => '1',
                                        'phone_number' => '+38 (057) 766 44 06',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/gallery/big/1351872471.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'        => '1',
                                                    'name'               => 'Lobby bar',
                                                    'facility_type_name' => 'General',
                                                    'short_description'  => 'The Kharkiv Palace Hotel lobby bar is an exclusive and stylish venue for business meetings and private gatherings.',
                                                    'description'        => 'The Kharkiv Palace Hotel lobby bar is an exclusive and stylish venue for business meetings and private gatherings. Spend a few pleasant moments drinking fresh coffee or tea while sampling some delicious cakes, or taste one of many excellent wines or cocktails accompanied by a light snack.

A perfect combination of convenient location, impeccable service and special atmosphere makes the lobby bar in the Kharkiv Palace Hotel one of the cityís most popular venues among those who appreciate true comfort and a relaxing time.

Opening hours: 24/7.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'        => '2',
                                                    'name'               => 'Лобби бар',
                                                    'facility_type_name' => 'Общие',
                                                    'short_description'  => 'Лобби бар отеля «Харьков Палас» — статусное место для встреч',
                                                    'description'        => 'Описание:',
                                                ),
                                            ),
                                        ),
                                    ),
                                    1 =>
                                    array(
                                        'id'           => '2',
                                        'phone_number' => '+38 (057) 766 44 22',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/gallery/big/1351246341.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'        => '1',
                                                    'name'               => 'Pacific Spoon Restaurant',
                                                    'facility_type_name' => 'General',
                                                    'short_description'  => 'The Pacific Spoon restaurant invites guests to experience an unbounded world of gastronomic delights.',
                                                    'description'        => 'The Kharkiv Palace Hotel lobby bar is an exclusive and stylish venue for business meetings and private gatherings. Spend a few pleasant moments drinking fresh coffee or tea while sampling some delicious cakes, or taste one of many excellent wines or cocktails accompanied by a light snack.

A perfect combination of convenient location, impeccable service and special atmosphere makes the lobby bar in the Kharkiv Palace Hotel one of the cityís most popular venues among those who appreciate true comfort and a relaxing time.

Opening hours: 24/7.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'        => '2',
                                                    'name'               => 'Ресторан Pacific Spoon',
                                                    'facility_type_name' => 'Общие',
                                                    'short_description'  => 'Pacific Spoon — удовольствие без границ',
                                                    'description'        => 'Описание:',
                                                ),
                                            ),
                                        ),
                                    ),
                                    2 =>
                                    array(
                                        'id'           => '3',
                                        'phone_number' => '+38 (057) 766 45 34',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/gallery/big/1351687515.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'        => '1',
                                                    'name'               => 'Amadeus Restaurant',
                                                    'facility_type_name' => 'General',
                                                    'short_description'  => 'Feel the unique charm of old Europe in traditional Vienna cafe Amadeus, designed to capture the look, taste and feel of a bygone era.',
                                                    'description'        => 'Feel the unique charm of old Europe in traditional Vienna cafe Amadeus, designed to capture the look, taste and feel of a bygone era. The atmosphere is elegant and cosy, with soft colour palettes to please the eye, and comfortable chairs in which to sit and sip Viennese coffee or bite into amazing Austrian, German and Swiss delicacies from the cafeís a la Òarte menu.

Amadeus has seating for 60, with the terrace creating space for an additional 40 persons in summer time.

Open daily from 08:00am to 11:00pm',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'        => '2',
                                                    'name'               => 'Ресторан Amadeus',
                                                    'facility_type_name' => 'Общие',
                                                    'short_description'  => 'Ресторан Amadeus — откройте для себя изысканный вкус императорской Вены!',
                                                    'description'        => 'Описание:',
                                                ),
                                            ),
                                        ),
                                    ),
                                    3 =>
                                    array(
                                        'id'           => '4',
                                        'phone_number' => '+38 (057) 766 45 32',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/gallery/big/1352217671.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'        => '1',
                                                    'name'               => 'The Sky Lounge Bar',
                                                    'facility_type_name' => 'General',
                                                    'short_description'  => 'Terms such as chic and cutting edge describe the Sky Lounge Bar club restaurant, which takes pleasure to a whole new level.',
                                                    'description'        => 'Terms such as chic and cutting edge describe the Sky Lounge Bar club restaurant, which takes pleasure to a whole new level. Enjoy panoramic views over downtown Kharkiv while sampling from an exclusive collection of premium finger foods. Live music plays nightly to liven up the mood. From 2:00pm to 5:00pm every day, consider indulging in various sorts of exquisite ìSky-Highî tea that are exclusive to the Sky Lounge.

Open daily from 12:00pm to 2:00am.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'        => '2',
                                                    'name'               => 'Бар Sky Lounge',
                                                    'facility_type_name' => 'Общие',
                                                    'short_description'  => 'Панорамный бар SkyLounge — выше только звезды!',
                                                    'description'        => 'Описание:',
                                                ),
                                            ),
                                        ),
                                    ),
                                    4 =>
                                    array(
                                        'id'           => '5',
                                        'phone_number' => '+38 (057) 766 49 19',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/gallery/big/1351597912.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'        => '1',
                                                    'name'               => 'Terrace Grill',
                                                    'facility_type_name' => 'General',
                                                    'short_description'  => 'The Terrace Grill restaurant takes grilled foods to unprecedented levels in an ultra-modern setting.',
                                                    'description'        => 'The Terrace Grill restaurant takes grilled foods to unprecedented levels in an ultra-modern setting. The restaurantís unique menu achieves the pinnacle of culinary mastery, while a high level of service contributes to an inimitable dining experience. The restaurant enjoys amazing views overlooking a nearby park and the cityís main square, Freedom Square. The restaurant offers an exclusive collection of grilled dishes, appetizers, an extensive menu of homemade ice cream and a deep wine list. The restaurant can accommodate up to 120 persons.

Open daily
from 11:00 am to 11:00 pm in winter
from 11:00 am to 2:00 am in summer',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'        => '2',
                                                    'name'               => 'Гриль-ресторан «The Terrace»',
                                                    'facility_type_name' => 'Общие',
                                                    'short_description'  => 'Гриль-ресторан «Терраса» — небесное удовольствие',
                                                    'description'        => 'Описание:',
                                                ),
                                            ),
                                        ),
                                    ),
                                    5 =>
                                    array(
                                        'id'           => '6',
                                        'phone_number' => '+38 (057) 766 45 35',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/gallery/big/1351523603.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'        => '1',
                                                    'name'               => 'Gourmet Beriozka Delicatessen Shop',
                                                    'facility_type_name' => 'General',
                                                    'short_description'  => 'Beryozka is a small, sophisticated delicatessen with an inviting atmosphere and a huge selection of delicacies.',
                                                    'description'        => 'Beryozka is a small, sophisticated delicatessen with an inviting atmosphere and a huge selection of delicacies. Order fresh Viennese pastries, sandwiches, cakes, special or regular coffee to go, French pates and custards, aromatic oils and sauces, Kharkiv Palace house wine and sparkling wine. Itís just the place to buy a one-of-a-kind souvenir or gift.

Our chef from Germany Hans Gorsler created a special sandwich menu from which to choose ñ enough to impress even the most demanding tastes!

All pastries, desserts and sandwiches are 50% off from 6pm to 10pm daily.

Open daily from 8:00am to 10:00pm.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'        => '2',
                                                    'name'               => 'Магазин деликатесов «Берёзка»',
                                                    'facility_type_name' => 'Общие',
                                                    'short_description'  => 'Магазин деликатесов в Харькове — вкусное предложение для настоящих гурманов',
                                                    'description'        => 'Описание:',
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        3 =>
                        array(
                            'module_type_id'     => '4',
                            'module_instance_id' => '4',
                            'homescreen'         => 'true',
                            'icon_homescreen'    => 'http://icon_homescreen4.png',
                            'module_order'       => '4',
                            'languages'          =>
                            array(
                                'language' =>
                                array(
                                    0 =>
                                    array(
                                        'language_id' => '1',
                                        'name'        => 'POI',
                                    ),
                                    1 =>
                                    array(
                                        'language_id' => '2',
                                        'name'        => 'Места',
                                    ),
                                ),
                            ),
                            'items'              =>
                            array(
                                'item' =>
                                array(
                                    0 =>
                                    array(
                                        'id'           => '1',
                                        'latitude'     => '50.005243',
                                        'longitude'    => '36.23299',
                                        'website_url'  => 'www.shato.com.ua',
                                        'email'        =>
                                        array(
                                        ),
                                        'phone_number' => '(057) 766-55-57',
                                        'icon_logo'    => 'http://kiev.shato.com.ua/sites/all/themes/shato/logo.png',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Slavutich Shato Pivovarnia',
                                                    'poi_type_name'     => 'Bars and Restaurants',
                                                    'short_description' => 'Long text with POI description',
                                                    'description'       => 'Even longer text with complete Place-of-Interest description followed by a media-gallery etc.',
                                                    'address'           => 'pl. Svobody 7',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Славутич Шато Пивомания',
                                                    'poi_type_name'     => 'Бары и Рестораны',
                                                    'short_description' => 'Короткое описание',
                                                    'description'       => 'Более длинное описание. Более длинное описание',
                                                    'address'           => 'пл. Свободы 7',
                                                ),
                                            ),
                                        ),
                                    ),
                                    1 =>
                                    array(
                                        'id'           => '2',
                                        'latitude'     => '50.005236',
                                        'longitude'    => '36.233477',
                                        'website_url'  => 'www.intertop.ua',
                                        'email'        => 'top1-kh@mti.ua',
                                        'phone_number' => '(057) 714-15-54',
                                        'icon_logo'    => 'http://intertop.ua/res/modules/website/core/css/img/logo2012.png',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Intertop',
                                                    'poi_type_name'     => 'Shops and Supermarkets',
                                                    'short_description' => 'Long text with POI description',
                                                    'description'       => 'Even longer text with complete Place-of-Interest description followed by a media-gallery etc.',
                                                    'address'           => 'pl. Svobody 7',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Интертоп',
                                                    'poi_type_name'     => 'Магазины и Супермаркеты',
                                                    'short_description' => 'Короткое описание',
                                                    'description'       => 'Более длинное описание. Более длинное описание',
                                                    'address'           => 'пл. Свободы 7',
                                                ),
                                            ),
                                        ),
                                    ),
                                    2 =>
                                    array(
                                        'id'           => '3',
                                        'latitude'     => '50.008677',
                                        'longitude'    => '36.227179',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        =>
                                        array(
                                        ),
                                        'phone_number' => '(057) 752-06-60',
                                        'icon_logo'    =>
                                        array(
                                        ),
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'TET-A-TET',
                                                    'poi_type_name'     => 'Bars and Restaurants',
                                                    'short_description' => 'Long text with POI description',
                                                    'description'       => 'Even longer text with complete Place-of-Interest description followed by a media-gallery etc.',
                                                    'address'           => 'prosp Pravdy 7',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Тет-а-Тет',
                                                    'poi_type_name'     => 'Бары и Рестораны',
                                                    'short_description' => 'Короткое описание',
                                                    'description'       => 'Более длинное описание. Более длинное описание',
                                                    'address'           => 'проспект Правды 7',
                                                ),
                                            ),
                                        ),
                                    ),
                                    3 =>
                                    array(
                                        'id'           => '4',
                                        'latitude'     => '50.008677',
                                        'longitude'    => '36.227179',
                                        'website_url'  => 'pizzabella.com.ua',
                                        'email'        => 'info@pizzabella.com.ua',
                                        'phone_number' => '(057) 717-60-59',
                                        'icon_logo'    => 'http://pizzabella.com.ua/img/not_available.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Pizza Bella',
                                                    'poi_type_name'     => 'Bars and Restaurants',
                                                    'short_description' => 'Long text with POI description',
                                                    'description'       => 'Even longer text with complete Place-of-Interest description followed by a media-gallery etc.',
                                                    'address'           => 'prosp. Lenina 3',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Пицца Белла',
                                                    'poi_type_name'     => 'Бары и Рестораны',
                                                    'short_description' => 'Короткое описание',
                                                    'description'       => 'Более длинное описание. Более длинное описание',
                                                    'address'           => 'проспект Ленина 3',
                                                ),
                                            ),
                                        ),
                                    ),
                                    4 =>
                                    array(
                                        'id'           => '5',
                                        'latitude'     => '50.008532',
                                        'longitude'    => '36.226643',
                                        'website_url'  => 'www.nadra.com.ua',
                                        'email'        =>
                                        array(
                                        ),
                                        'phone_number' => '(057) 705-46-43',
                                        'icon_logo'    => 'http://www.nadra.com.ua/site/images/logo_ru.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Nadra Bank #32',
                                                    'poi_type_name'     => 'Banks and ATM',
                                                    'short_description' => 'Long text with POI description',
                                                    'description'       => 'Even longer text with complete Place-of-Interest description followed by a media-gallery etc.',
                                                    'address'           => 'prosp. Pravdy 7',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Надра Банк',
                                                    'poi_type_name'     => 'Банки и Банкоматы',
                                                    'short_description' => 'Короткое описание',
                                                    'description'       => 'Более длинное описание. Более длинное описание',
                                                    'address'           => 'пл. Свободы 7',
                                                ),
                                            ),
                                        ),
                                    ),
                                    5 =>
                                    array(
                                        'id'           => '6',
                                        'latitude'     => '50.003367',
                                        'longitude'    => '36.235962',
                                        'website_url'  => 'www.otpbank.com.ua',
                                        'email'        =>
                                        array(
                                        ),
                                        'phone_number' => '(800) 300-050',
                                        'icon_logo'    => 'http://www.otpbank.com.ua/bitrix/templates/TOTPB/images/logo_otp_bank.png',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'OTP Bank',
                                                    'poi_type_name'     => 'Banks and ATM',
                                                    'short_description' => 'Long text with POI description',
                                                    'description'       => 'Even longer text with complete Place-of-Interest description followed by a media-gallery etc.',
                                                    'address'           => 'st. Sumskaya 56',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'ОТП Банк',
                                                    'poi_type_name'     => 'Банки и Банкоматы',
                                                    'short_description' => 'Короткое описание',
                                                    'description'       => 'Более длинное описание. Более длинное описание',
                                                    'address'           => 'ул. Сумская 56',
                                                ),
                                            ),
                                        ),
                                    ),
                                    6 =>
                                    array(
                                        'id'           => '7',
                                        'latitude'     => '50.003026',
                                        'longitude'    => '36.235838',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        =>
                                        array(
                                        ),
                                        'phone_number' => '(057) 762-64-92',
                                        'icon_logo'    =>
                                        array(
                                        ),
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Pharmacy #1',
                                                    'poi_type_name'     => 'Health and Pharmacy',
                                                    'short_description' => 'Long text with POI description',
                                                    'description'       => 'Even longer text with complete Place-of-Interest description followed by a media-gallery etc.',
                                                    'address'           => 'st. Sumskaya 60',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Аптека',
                                                    'poi_type_name'     => 'Здоровье',
                                                    'short_description' => 'Короткое описание',
                                                    'description'       => 'Более длинное описание. Более длинное описание',
                                                    'address'           => 'ул. Сумская 60',
                                                ),
                                            ),
                                        ),
                                    ),
                                    7 =>
                                    array(
                                        'id'           => '8',
                                        'latitude'     => '50.005836',
                                        'longitude'    => '36.233327',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        =>
                                        array(
                                        ),
                                        'phone_number' => '(057) 758-02-87',
                                        'icon_logo'    => 'http://restoran.kharkov.ua/images/product_images/info_images/560_0.jpeg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Mario',
                                                    'poi_type_name'     => 'Bars and Restaurants',
                                                    'short_description' => 'Long text with POI description',
                                                    'description'       => 'Even longer text with complete Place-of-Interest description followed by a media-gallery etc.',
                                                    'address'           => 'st. Trinklera 2',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Марио',
                                                    'poi_type_name'     => 'Бары и Рестораны',
                                                    'short_description' => 'Короткое описание',
                                                    'description'       => 'Более длинное описание. Более длинное описание',
                                                    'address'           => 'ул. Тринклера 2',
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        4 =>
                        array(
                            'module_type_id'     => '5',
                            'module_instance_id' => '5',
                            'homescreen'         => 'true',
                            'icon_homescreen'    => 'http://icon_homescreen5.png',
                            'module_order'       => '8',
                            'languages'          =>
                            array(
                                'language' =>
                                array(
                                    0 =>
                                    array(
                                        'language_id' => '1',
                                        'name'        => 'Offers',
                                    ),
                                    1 =>
                                    array(
                                        'language_id' => '2',
                                        'name'        => 'Предложения',
                                    ),
                                ),
                            ),
                            'items'              =>
                            array(
                                'item' =>
                                array(
                                    0 =>
                                    array(
                                        'id'           => '1',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        =>
                                        array(
                                        ),
                                        'phone_number' => '+38 (057) 766 44 00',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/special-offers/1352722686_en.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Special New Year Offer: A Golden Night at the Kharkiv Palace',
                                                    'short_description' => 'Celebrate a memorable New Year but leave your wallet at home! This New Yearís Eve, the Kharkiv Palace Hotel offers its ìAll Inclusiveî event package.',
                                                    'description'       => 'Celebrate a memorable New Year but leave your wallet at home! This New Yearís Eve, the Kharkiv Palace Hotel offers its ìAll Inclusiveî event package.*

Guests of the evening can expect:
 - red carpet;
 - first-class cuisine (deluxe smorgasbord);
 - MC;
 - Incredible entertainment show;
 - a river of champagne;
 - live music and DJ;
 - childrenís cartoons;
 - fireworks at midnight;
 - professional photographer;
 - raffle for a chance to win a night in the Kharkiv Palace Hotel;
 - and Santa Claus!

01/01/2013 - energetic after-party (soup, grill menu and lots of surprises).

And for those who want to spend New Yearís Eve in the Kharkiv Palace Hotel, we have special offers with generous discounts for accommodation:
 - New Yearís programme for UAH 2,013/person. + 40% discount for one night accommodation;
 - New Yearís programme for UAH 2,013/person. + 45% discount for two nights accommodations;
 - New Yearís programme for UAH 2,013/person. + after-party brunch for UAH 300 + 45% discount for one night accommodation;
 - New Yearís programme for UAH 2,013/person + after-party brunch for UAH 300 + 50% discount for two nights accommodations.

The above offers include use of the swimming pool and fitness centre, free massages (advance booking needed during the New Year period or within one month following check-out) and early check-in and late check-out (by prior arrangement) and free parking.

*Cost of just the New Yearís program is UAH 2,013. Book in November and receive a 10% discount.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              =>
                                                    array(
                                                    ),
                                                    'short_description' =>
                                                    array(
                                                    ),
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    1 =>
                                    array(
                                        'id'           => '2',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        => 'sc@kharkiv-palace.com',
                                        'phone_number' => '+38 (057) 766 44 38',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/special-offers/1352986298_en.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'An Epicentre of Corporate Events at the Kharkiv Palace Hotel!',
                                                    'short_description' => 'Just prior to the New Year all successful companies are thinking about organising their own corporate New Yearís event. The Kharkiv Palace Hotel is always happy to offer its services.',
                                                    'description'       => 'Just prior to the New Year all successful companies are thinking about organising their own corporate New Yearís event. A corporate New Yearís party is a great way to join with colleagues and build team unity and strength. Such an inclusive event also helps sum up the year and reward the most outstanding employees in a festive atmosphere.

The Kharkiv Palace Hotel is always happy to offer its services:
 - Restaurants and halls for events from 10 to 300 people;
 - A wide range of banquet menus from UAH 450/ person;
 - Exquisite floral designs in the best European tradition;
 - Accommodation in comfortable rooms;
 - Organisation of entertainment programmes to suit any budget or mood;
 - Help in creating unique event themes;
 - Professional banquet service;
 - Concert sound and lighting equipment, including video and photography;
 - Personal coordinator to provide an individual approach to organising any event.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              =>
                                                    array(
                                                    ),
                                                    'short_description' =>
                                                    array(
                                                    ),
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    2 =>
                                    array(
                                        'id'           => '3',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        => 'reservation@kharkiv-palace.com',
                                        'phone_number' => '+38 (057) 766 44 45',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/special-offers/1353067098_en.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Presents from the Kharkiv Palace: 3 nights for the price of 2!',
                                                    'short_description' => 'Book a Premier category room* for two nights and get the third for free.',
                                                    'description'       => 'Extend your stay in Kharkiv at the luxurious Kharkiv Palace Hotel and enjoy more of the good things in life.
Book a Premier category room* for two nights and get the third for free.

*Offer is valid only for reservations made via the hotel website.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              =>
                                                    array(
                                                    ),
                                                    'short_description' =>
                                                    array(
                                                    ),
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    3 =>
                                    array(
                                        'id'           => '4',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        => 'reservation@kharkiv-palace.com',
                                        'phone_number' => '+38 (057) 766 44 45',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/special-offers/1352384206_en.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Premier Romantic Weekend package',
                                                    'short_description' => 'Real romance never goes out of style! Present your sweetheart with a magical weekend getaway in the luxurious Kharkiv Palace Hotel.',
                                                    'description'       => 'Real romance never goes out of style! Present your sweetheart with a magical weekend getaway in the luxurious Kharkiv Palace Hotel.

For you:
 - Accommodation for two in a Premier room;
 - A gift from the hotel upon arrival (champagne, strawberries in chocolate and handmade pastries);
 - Breakfast in the room;
 - Gift certificate for a 20% discount at any Kharkiv Palace restaurant*;
 - Late check out until 6pm (must be arranged in advance)

Package price: UAH 1,592.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              =>
                                                    array(
                                                    ),
                                                    'short_description' =>
                                                    array(
                                                    ),
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    4 =>
                                    array(
                                        'id'           => '5',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        => 'reservation@kharkiv-palace.com',
                                        'phone_number' => '+38 (057) 766 44 45',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/special-offers/1340353684_en.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Grand Royal wedding banquet package',
                                                    'short_description' => 'The ultimate wedding package from the Kharkiv Palace Hotel, the epitome of 3rd millennium luxury with impeccable service.',
                                                    'description'       => 'The ultimate wedding package from the Kharkiv Palace Hotel, the epitome of 3rd millennium luxury with impeccable service. Ballroom for 300 guests specially decorated to highlight a once-in-a- lifetime event! A unique menu just for the occasion, professional floral arrangements at every table, just let us take care of every detail.

For you:
 - A personal wedding coordinator to organise and plan your wedding;
 - Choice of halls with capacity up to 300 people;
 - Professional audio and visual equipment;
 - Exclusive cakes from a leading European confectioner;
 - A convenient foyer area for the wedding ceremony;
 - 15% discount on guestsí accommodation.

UAH 1,200 per person (min. 50 people).

Price includes:
 - Unique menu;
 - Hall rental;
 - Professional decoration;
 - Equipment (screen and projector);
 - Premier Wedding Package accommodations as a gift for the newlyweds.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              =>
                                                    array(
                                                    ),
                                                    'short_description' =>
                                                    array(
                                                    ),
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    5 =>
                                    array(
                                        'id'           => '6',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        => 'reservation@kharkiv-palace.com',
                                        'phone_number' => '+38 (057) 766-44-45',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/special-offers/1340030754_en.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Wedding Night at the Palace',
                                                    'short_description' => 'Start your new life in the lapof luxuriously! Make your wedding night a special one featuring a luxurious room with romantic decor, champagne, a massage for two, breakfast in bed and more!',
                                                    'description'       => 'Start your new life in the lap of luxuriously! Make your wedding night a special one featuring a luxurious room with romantic decor, champagne, a massage for two, breakfast in bed and more!

The Kharkiv Palace Hotel will create a fabulous personal palace for you and your new spouse, where all of your desires are fulfilled and la dolce vita truly begins. Take advantage of the Kharkiv Palace Hotelís special offer for newly married couples on their wedding day:
Premier package ñ UAH 2,012 (one-night stay for two)
Royal package ñ UAH 4,024 (two-night stay for two)

Package includes:
 - Accommodation in a Premier category room
 - Festiveroom decor
 - Wedding gift from the hotel (bottle of sparkling wine and chocolate-dipped strawberries)Romantic honeymoon setting (relaxing essential oils, bath bomb, face and body creams)
 - Breakfast in the room
 - Use of the swimming pool, sauna, Turkish bathand gym
 - Two full massage sessions (reservations recommended)
 - Guarded parking (for one vehicle)
 - Free late check-out (until 6pm, by prior agreement)

As well Premier package includes a gift certificate for use at any Kharkiv Palace restaurants good for 15% off.

Royal package also includes a romantic dinner with a special menu at the Pacific Spoon restaurant and gift certificate for 20% off our published rate for accommodations on the day of your anniversary or a return stay (with prior reservation).

Either package would make a great wedding gift for your friends and loved ones.

To order this wedding package, advance booking is required.
Please note that a marriage registration certificate must be presented upon arrival.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              =>
                                                    array(
                                                    ),
                                                    'short_description' =>
                                                    array(
                                                    ),
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    6 =>
                                    array(
                                        'id'           => '7',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        => 'reservation@kharkiv-palace.com',
                                        'phone_number' => '+38 (057) 766 44 45',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/special-offers/1347982609_en.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Trip plus gifts from the hotel guaranteed!',
                                                    'short_description' => 'If taking a trip to Kharkiv, stay at the Kharkiv Palace Hotel in the heart of downtown Kharkiv!',
                                                    'description'       => 'If taking a trip to Kharkiv, stay at the Kharkiv Palace Hotel in the heart of downtown Kharkiv!

The hotel offers dinner at the Pacific Spoon restaurant with its exclusive Pacific Rim cuisine for just UAH 250* (plus free guarded parking) during the period of your stay**.

*Dinner does not include alcoholic beverages.
**Offer is not valid for group accomodation.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              =>
                                                    array(
                                                    ),
                                                    'short_description' =>
                                                    array(
                                                    ),
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    7 =>
                                    array(
                                        'id'           => '8',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        => 'reservation@kharkiv-palace.com',
                                        'phone_number' => '+38 (057) 766 44 45',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/special-offers/1351080040_en.JPG',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Now you can travel with your four-legged friends!',
                                                    'short_description' => 'Kharkiv Palace Hotel has opened its doors to guests who travel with their pets, and offers their special "Favourite Pet" package',
                                                    'description'       => 'Now you can travel with your four-legged friends! We know how hard it is to leave your furry friends at home while you travel.
Fortunately, the luxurious Kharkiv Palace Hotel has opened its doors to guests who travel with their pets, and offers their special "Favourite Pet" package worth UAH 300 per day.
The package includes a bed for the little creature, dishes for food, special napkins and even a Kharkiv Palace chocolate.
Travel and see the world with your pet!',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              =>
                                                    array(
                                                    ),
                                                    'short_description' =>
                                                    array(
                                                    ),
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    8 =>
                                    array(
                                        'id'           => '9',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        => 'reservation@kharkiv-palace.com',
                                        'phone_number' => '+38 (057) 766 44 45',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/special-offers/1353075043_en.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Kids Package',
                                                    'short_description' => 'As always, the staff and management of the Kharkiv Palace Hotel endeavour to make your stay as comfortable, interesting and exciting as possible, and to that end the hotel has launched a special children',
                                                    'description'       => 's package for guests staying with children.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              =>
                                                    array(
                                                    ),
                                                    'short_description' =>
                                                    array(
                                                    ),
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    9 =>
                                    array(
                                        'id'           => '10',
                                        'website_url'  =>
                                        array(
                                        ),
                                        'email'        => 'sc@kharkiv-palace.com',
                                        'phone_number' => '+38 (057) 766 44 38',
                                        'icon_logo'    => 'http://kharkiv-palace.com/assets/images/special-offers/1341224136_en.jpg',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Happy Birthday Party',
                                                    'short_description' => 'Want to celebrate your birthday or anniversary in a remarkable and one-of-a-kind fashion? Want to impress friends or just indulge in impeccable service?',
                                                    'description'       => 'Want to celebrate your birthday or anniversary in a remarkable and one-of-a-kind fashion? Want to impress friends or just indulge in impeccable service? Then the Kharkiv Palace Hotel is the perfect choice!

Spacious rooms and restaurants for 10 to 300 people, luxurious surroundings, elegant interiors, perfect table settings, and all of it to emphasize the importance and exclusivity of any special event. Trust the Kharkiv Palace and its highly trained specialists to help organize and your next important event in perfect style.

You just have to show up and enjoy!

The basic package* includes:
 - Special holiday menu exclusively for the birthday celebrant and guests;
 - 15% discount on accommodations for birthday guests;
 - Special complementary gift for the birthday child;
 - Free accommodation in a Premier category double room (one night);
 - Complementary in-room gift of sparkling wine and fruit;
 - In-room breakfast;
 - Use of the hotel swimming pool, sauna and Turkish steam bath;
 - Free use of the gym;
 - Guarded parking for one car;
 - Free late check out (until 6pm, based on prior arrangement);
 - Kharkiv Palace loyalty card (10% discount).

*UAH 800 per person (min. 30 people).',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              =>
                                                    array(
                                                    ),
                                                    'short_description' =>
                                                    array(
                                                    ),
                                                    'description'       =>
                                                    array(
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        5 =>
                        array(
                            'module_type_id'     => '6',
                            'module_instance_id' => '6',
                            'homescreen'         => 'true',
                            'icon_homescreen'    => 'http://icon_homescreen6.png',
                            'module_order'       => '9',
                            'languages'          =>
                            array(
                                'language' =>
                                array(
                                    0 =>
                                    array(
                                        'language_id' => '1',
                                        'name'        => 'Gallery',
                                    ),
                                    1 =>
                                    array(
                                        'language_id' => '2',
                                        'name'        => 'Галерея',
                                    ),
                                ),
                            ),
                            'items'              =>
                            array(
                                'item' =>
                                array(
                                    0 =>
                                    array(
                                        'id'          => '1',
                                        'image_big'   => 'http://kharkiv-palace.com/assets/images/gallery/big/1331828940.jpg',
                                        'image_small' => 'http://kharkiv-palace.com/assets/images/gallery/small/1331828940.jpg',
                                        'type'        => 'jpg',
                                        'languages'   =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'short_description' => 'Picture 1',
                                                    'description'       => 'Long description picture 1',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'short_description' => 'Фото 1',
                                                    'description'       => 'Полное описание фотографии 1',
                                                ),
                                            ),
                                        ),
                                    ),
                                    1 =>
                                    array(
                                        'id'          => '2',
                                        'image_big'   => 'http://kharkiv-palace.com/assets/images/gallery/big/1352457934.jpg',
                                        'image_small' => 'http://kharkiv-palace.com/assets/images/gallery/small/1352457934.jpg',
                                        'type'        => 'jpg',
                                        'languages'   =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'short_description' => 'Picture 2',
                                                    'description'       => 'Long description picture 2',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'short_description' => 'Фото 2',
                                                    'description'       => 'Полное описание фотографии 2',
                                                ),
                                            ),
                                        ),
                                    ),
                                    2 =>
                                    array(
                                        'id'          => '3',
                                        'image_big'   => 'http://kharkiv-palace.com/assets/images/gallery/big/1352457969.jpg',
                                        'image_small' => 'http://kharkiv-palace.com/assets/images/gallery/small/1352457969.jpg',
                                        'type'        => 'jpg',
                                        'languages'   =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'short_description' => 'Picture 3',
                                                    'description'       => 'Long description picture 3',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'short_description' => 'Фото 3',
                                                    'description'       => 'Полное описание фотографии 3',
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        6 =>
                        array(
                            'module_type_id'     => '7',
                            'module_instance_id' => '7',
                            'homescreen'         => 'true',
                            'icon_homescreen'    => 'http://icon_homescreen7.png',
                            'module_order'       => '6',
                            'languages'          =>
                            array(
                                'language' =>
                                array(
                                    0 =>
                                    array(
                                        'language_id' => '1',
                                        'name'        => 'Phones',
                                    ),
                                    1 =>
                                    array(
                                        'language_id' => '2',
                                        'name'        => 'Телефоны',
                                    ),
                                ),
                            ),
                            'items'              =>
                            array(
                                'item' =>
                                array(
                                    0 =>
                                    array(
                                        'id'           => '1',
                                        'phone_number' => '101',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Fire department',
                                                    'short_description' => 'Short description',
                                                    'description'       => 'Long description',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Пожарная часть',
                                                    'short_description' => 'Описание',
                                                    'description'       => 'Расширенное описание',
                                                ),
                                            ),
                                        ),
                                    ),
                                    1 =>
                                    array(
                                        'id'           => '2',
                                        'phone_number' => '102',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Police department',
                                                    'short_description' => 'Short description',
                                                    'description'       => 'Long description',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Милиция',
                                                    'short_description' => 'Описание',
                                                    'description'       => 'Расширенное описание',
                                                ),
                                            ),
                                        ),
                                    ),
                                    2 =>
                                    array(
                                        'id'           => '3',
                                        'phone_number' => '103',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Ambulance',
                                                    'short_description' => 'Short description',
                                                    'description'       => 'Long description',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Скорая помощь',
                                                    'short_description' => 'Описание',
                                                    'description'       => 'Расширенное описание',
                                                ),
                                            ),
                                        ),
                                    ),
                                    3 =>
                                    array(
                                        'id'           => '4',
                                        'phone_number' => '+38 (057) 766 44 00',
                                        'languages'    =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Hotel reception',
                                                    'short_description' => 'Short description',
                                                    'description'       => 'Long description',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Отель. Стойка регистрации',
                                                    'short_description' => 'Описание',
                                                    'description'       => 'Расширенное описание',
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        7 =>
                        array(
                            'module_type_id'     => '9',
                            'module_instance_id' => '9',
                            'homescreen'         => 'true',
                            'icon_homescreen'    => 'http://icon_homescreen9.png',
                            'module_order'       => '5',
                            'languages'          =>
                            array(
                                'language' =>
                                array(
                                    0 =>
                                    array(
                                        'language_id' => '1',
                                        'name'        => 'City map',
                                    ),
                                    1 =>
                                    array(
                                        'language_id' => '2',
                                        'name'        => 'Карта города',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            'dependencies' =>
            array(
                'masters' =>
                array(
                    'master' =>
                    array(
                        0 =>
                        array(
                            'id'     => '1',
                            'slaves' =>
                            array(
                                'slave' =>
                                array(
                                    0 =>
                                    array(
                                        'id' => '2',
                                    ),
                                    1 =>
                                    array(
                                        'id' => '3',
                                    ),
                                ),
                            ),
                        ),
                        1 =>
                        array(
                            'id'     => '4',
                            'slaves' =>
                            array(
                                'slave' =>
                                array(
                                    0 =>
                                    array(
                                        'id' => '3',
                                    ),
                                    1 =>
                                    array(
                                        'id'      => '2',
                                        'deleted' => 'true',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );        
        $package['1']       = array(
            'hotel'        =>
            array(
                'version'   => '1',
                'id'        => '1',
                'location'  => '50.006488, 36.232781',
                'languages' =>
                array(
                    'language' =>
                    array(
                        0 =>
                        array(
                            'language_id' => '1',
                            'name'        => 'Kharkiv Palace',
                        ),
                        1 =>
                        array(
                            'language_id' => '2',
                            'name'        => 'Харьков Палас',
                        ),
                    ),
                ),
                'modules'   =>
                array(
                    'module' =>
                    array(
                        0 =>
                        array(
                            'module_type_id'     => '1',
                            'module_instance_id' => '1',
                            'homescreen'         => 'true',
                            'icon_homescreen'    => 'http://icon_homescreen1.png',
                            'module_order'       => '1',
                            'languages'          =>
                            array(
                                'language' =>
                                array(
                                    0 =>
                                    array(
                                        'language_id' => '1',
                                        'name'        => 'Info',
                                    ),
                                    1 =>
                                    array(
                                        'language_id' => '2',
                                        'name'        => 'Информация',
                                    ),
                                ),
                            ),
                            'items'              =>
                            array(
                                'item' =>
                                array(
                                    'id'        => '1',
                                    'location'  => '50.006488, 36.232781',
                                    'email'     => 'info@kharkiv-palace.com',
                                    'url'       => 'http://kharkiv-palace.com',
                                    'languages' =>
                                    array(
                                        'language' =>
                                        array(
                                            0 =>
                                            array(
                                                'language_id' => '1',
                                                'name'        => 'Kharkiv Palace',
                                                'address'     => '61000, Kharkiv, prosp. Pravdy 2',
                                                'description' => 'Welcome to the Kharkiv Palace Hotel the first five-star 
                                                    hotel in Ukraine to embody third-millennium luxury! This 11-storey building, 
                                                    built in typical Kharkiv-style constructivism, seamlessly unites with the architectural
                                                    ensemble of the square. Its internal design combines the refinement of modern neo-classicism, 
                                                    functionality and the latest in building technologies. Included among the hotelís 180 rooms are 
                                                    the top-flight Presidential Suite and rooms of the Executive Floor.

The Kharkiv Palace Hotel is a member of the Premier Hotels management group ñ a collection 
of Ukrainian luxury hotels that offer signature personal touches while ensuring equally comfortable
and hospitable accommodation. Most hotels are historic landmarks in their cities, each one with its own 
unique style, local accents and inimitable charm.',
                                            ),
                                            1 =>
                                            array(
                                                'language_id' => '2',
                                                'name'        => 'Харьков Палас',
                                                'address'     => '61000, Харьков, пр. Правды 2',
                                                'description' => 'Добро пожаловть в Харьков Палас.',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        1 =>
                        array(
                            'module_type_id'     => '2',
                            'module_instance_id' => '2',
                            'homescreen'         => 'true',
                            'icon_homescreen'    => 'http://icon_homescreen2.png',
                            'module_order'       => '2',
                            'languages'          =>
                            array(
                                'language' =>
                                array(
                                    0 =>
                                    array(
                                        'language_id' => '1',
                                        'name'        => 'Rooms',
                                    ),
                                    1 =>
                                    array(
                                        'language_id' => '2',
                                        'name'        => 'Комнаты',
                                    ),
                                ),
                            ),
                            'items'              =>
                            array(
                                'item' =>
                                array(
                                    0 =>
                                    array(
                                        'id'        => '1',
                                        'price'     => '200',
                                        'icon_logo' => 'http://---/1.png',
                                        'languages' =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Classic Room',
                                                    'short_description' => 'Current Rate: 1600 UAH',
                                                    'room_type_name'    => 'Classic Room',
                                                    'description'       => 'This cozy space is decorated in warm, comforting tones 
                                                        and features lots of natural woods and soft fabrics. The room offers everything
                                                        necessary for both working in comfort and relaxing, including a separate work area and 
                                                        a large bed. The room is ideal for either single or double occupancy.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'КЛАССИЧЕСКИЙ НОМЕР',
                                                    'short_description' => 'Текущая цена: 1600 UAH',
                                                    'room_type_name'    => 'КЛАССИЧЕСКИЙ НОМЕР',
                                                    'description'       => 'Уютный однокомнатный номер, оформленный в теплых естественных тонах с использованием 
                                                        натурального дерева и тканей. В номере есть все необходимое для комфортной работы и отдыха: полноценное рабочее место, 
                                                        широкая кровать. Номер идеально подходит как для одноместного так и двухместного размещения.',
                                                ),
                                            ),
                                        ),
                                    ),
                                    1 =>
                                    array(
                                        'id'        => '2',
                                        'price'     => '245',
                                        'icon_logo' => 'http://---/2.png',
                                        'languages' =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Premier',
                                                    'short_description' => 'Current Rate: 1990 UAH',
                                                    'room_type_name'    => 'Premier',
                                                    'description'       => 'A spacious room featuring a comfortable workspace and seating area, and designed in
                                                        bright, warm colors and with generous use of natural materials. The room has a special atmosphere and boasts 
                                                        panoramic windows that offer spectacular views of the city.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Премьер',
                                                    'short_description' => 'Текущая цена: 1990 UAH',
                                                    'room_type_name'    => 'Премьер',
                                                    'description'       => 'Просторный однокомнатный номер c комфортной рабочей зоной и зоной отдыха. 
                                                        Интерьер номера выполнен в светлых, теплых тонах с использованием натуральных материалов. 
                                                        Особую атмосферу номера создают широкие панорамные окна, которые открывают великолепный вид на город.',
                                                ),
                                            ),
                                        ),
                                    ),
                                    2 =>
                                    array(
                                        'id'        => '3',
                                        'price'     => '370',
                                        'icon_logo' => 'http://---/3.png',
                                        'languages' =>
                                        array(
                                            'language' =>
                                            array(
                                                0 =>
                                                array(
                                                    'language_id'       => '1',
                                                    'name'              => 'Delux',
                                                    'short_description' => 'Current Rate: 2990 UAH',
                                                    'room_type_name'    => 'Delux',
                                                    'description'       => 'A spacious room with a gorgeous, brightly-colored interior. The room
                                                        offers unimpeachable comfort and harmoniously combines areas for sleeping, working, and relaxing.
                                                        The well-designed layout visually increases the room’s space, especially that part intended for
                                                        entertaining guests or or otherwise enjoying a leisurely moment. The sleeping space, meanwhile,
                                                        is designed for especial privacy. This room is the perfect choice for a business trip or for a family with children.',
                                                ),
                                                1 =>
                                                array(
                                                    'language_id'       => '2',
                                                    'name'              => 'Делюкс',
                                                    'short_description' => 'Текущая цена: 2990 UAH',
                                                    'room_type_name'    => 'Делюкс',
                                                    'description'       => 'Просторный номер с великолепным интерьером, оформленным в светлых тонах. 
                                                        В номере очень удобно и гармонично объединены зоны для сна, работы и отдыха. Хорошо продуманная
                                                        планировка визуально увеличивает пространство номера, особенно часть, предназначенную для приема гостей
                                                        или отдыха, и создает особую приватность в зоне сна. Номер идеально подходит как для делового визита, так и для семьи с детьми.',
                                                ),
                                            ),
                                        ),
                                    ),
                                    3 =>
                                    array(
                                        'id'      => '9',
                                        'deleted' => 'true',
                                    ),
                                    4 =>
                                    array(
                                        'id'      => '18',
                                        'deleted' => 'true',
                                    ),
                                ),
                            ),
                        ),
                        2 =>
                        array(
                            'module_instance_id' => '78',
                            'deleted'            => 'true',
                        ),
                    ),
                ),
            ),
            'dependencies' =>
            array(
                'masters' =>
                array(
                    'master' =>
                    array(
                        0 =>
                        array(
                            'id'     => '1',
                            'slaves' =>
                            array(
                                'slave' =>
                                array(
                                    0 =>
                                    array(
                                        'id' => '2',
                                    ),
                                    1 =>
                                    array(
                                        'id' => '3',
                                    ),
                                ),
                            ),
                        ),
                        1 =>
                        array(
                            'id'     => '4',
                            'slaves' =>
                            array(
                                'slave' =>
                                array(
                                    0 =>
                                    array(
                                        'id' => '3',
                                    ),
                                    1 =>
                                    array(
                                        'id'      => '2',
                                        'deleted' => 'true',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
        if (isset($params['version']) && isset($package[$params['version']])) {
            return $package[$params['version']];
        } else {
            return $package['default'];
        }
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

}

?>
