<?php
class Russian{
//    for grid
    public $next = 'Следующий';
    public $edit = 'Редактировать';
    public $update = 'Обновить';
    public $cancel = 'Отменить';
    public $destroy = 'Удалить';
    public $createNew = 'Добавить новую запись';
    public $name = 'Название';
    public $old_name = 'Старое название';

//    menu items
    public $download_file = 'Скачать файл';
    public $file = 'Файл';
    public $open = 'Открыть';
    public $addTo = 'Добавить в';
    public $search = 'Поиск';
    public $dictionaries = 'Словари';
    public $exit = 'Выйти';
    public $reset = 'Сброс';
//    bibliography
    public $date_and_time = "Дата и время индексирования";
    public $date_and_time_date = "Дата индексирования";
    public $date_and_time_time = "Время индексирования";
    public $organ = "Орган, предоставивший информацию";
    public $created_user = 'Лицо, индексировавшее документ';
    public $worker_take_doc = 'Оперработник, получивший документ';
    public $source_agency = 'Орган, где хранятся первич. материалы';
    public $source_address = 'Адрес хранения первич. материалов';
    public $short_desc = 'Краткое содержание документа';
    public $related_year = 'Сведения относятся к году';
    public $source_inf = 'Источник информации';
    public $inf_cont = 'Содержит информацию о';
//    man adding
    public $last_name = 'Фамилия';
    public $first_name = 'Имя';
    public $middle_name = 'Отчество';
    public $also_known_as = 'Известен(а) также как';
    public $face_face = 'Лицо - Лицо';
    public $date_of_birth = 'Дата рождения (число.месяц.год)';
    public $date_of_birth_y = 'Др.(год)';
    public $date_of_birth_m = 'Др.(месяц)';
    public $date_of_birth_d = 'Др.(число)';
    public $approximate_year = 'Примерный год рождения';
    public $passport_number = 'Номер паспорта';
    public $gender = 'Пол';
    public $nationality = 'Национальность';
    public $citizenship = 'Гражданство';
    public $place_of_birth = 'Место рождения (страна, АТЕ)';
    public $place_man = 'Место рождения';
    public $place_of_birth_area_local = 'Место рождения (район-местный)';
    public $place_of_birth_settlement_local = 'Место рождения (нас.пункт-местный)';
    public $place_of_birth_area = 'Место рождения (район)';
    public $place_of_birth_settlement = 'Место рождения (населенный пункт)';
    public $knowledge_of_languages = 'Знание языков';
    public $place_of_residence_person = 'Место жительства лица';
    public $telephone_number = 'Номер телефона';
    public $attention = 'Внимание!';
    public $additional_information_person = 'Дополнительные данные о лице';
    public $person_described_in_the_abstract = 'Лицо описано в реферате';
    public $worship = 'Вероисповедание';
    public $occupation = 'Род занятий';
    public $operational_category_person = 'Оперативная категория лица';
    public $country_carrying_out_search = 'Страна, осуществляющая розыск';
    public $declared_wanted_list_with = 'Розыск объявлен с:';
    public $home_monitoring_start = 'Начало контроля въезда в РА';
    public $end_monitoring_start = 'Конец контроля въезда в РА';
    public $education = 'Образование. Ученая степень, звание';
    public $party = 'Партийность';
    public $work_experience_person = 'Трудовая деятельность лица';
    public $stay_abroad = 'Пребывание за границей';
    public $external_signs = 'Внешние приметы';


    public $external_signs_photo = 'Внешние приметы (фото)';
    public $alias = 'Псевдоним (кличка)';
    public $oper_ties = 'Связи, представляющие опер. интерес';
    public $oper_ties_man = 'Связи, представляющие опер. интерес (лицо)';
    public $oper_ties_organization = 'Связи, представляющие опер. интерес (орг.)';
    public $face_opened = 'На лицо заведено ДОУ';
    public $member_actions = 'Участник действия';
    public $to_event = 'Имеет отношение к событию';
    public $source_information = 'Источник информации о лице';
    public $test_signal = 'Является объектом проверки сигнала';
    public $passes_signal = 'Проходит по сигналу';
    public $passes_signal_man = 'Проходит по сигналу (лицо)';
    public $passes_signal_organization = 'Проходит по сигналу (организация)';
    public $criminal_case = 'Заведено уголовное дело';
    public $passes_summary = 'Проходит по сводке МВД';
    public $presence_machine = 'Наличие автомашины';
    public $presence_weapons = 'Наличие оружия';
    public $uses_machine = 'Использует автомашину';
    public $bibliography = 'Библиография';
    public $answer= 'Ответ';
// phone adding
    public $phone_number= 'Номер телефона';
    public $nature_character= 'Характер владения';
    public $nature_character_man = 'Характер владения (Лицо)';
    public $nature_character_organization = 'Характер владения (Организация)';
    public $additional_data= 'Дополнительные данные';
    public $phone_owner= 'Владелец телефона';
    public $phone_owner_man= 'Владелец телефона (Лицо)';
    public $phone_owner_organization= 'Владелец телефона (Организация)';
    public $real_action= 'Является объектом действия';
    public $real_event= 'Является объектом  события';
    public $mail_address= 'Электронный адрес (e-mail)';

// car adding
    public $category = 'Категория';
    public $car_cat = 'Категория';
    public $weapon_cat = 'Категория';
    public $mark = 'Марка';
    public $color = 'Цвет (или др. отличит. знаки)';
    public $car_number = 'Госномер';
    public $count = 'Количество';
    public $person_organization = 'Принадлежит лицу, организации';
    public $person_organization_man = 'Принадлежит лицу';
    public $person_organization_organization = 'Принадлежит организации';
    public $person_address = 'Находится у лица, адрес';
    public $person_address_man = 'Находится у лица';
    public $person_address_address = 'Находится, адрес';
    public $actions_events = 'Принимала участие в действиях, событиях';
    public $actions_events_action = 'Принимала участие в действиях';
    public $actions_events_event = 'Принимала участие в событиях';
// weapon adding
    public $view = 'Вид';
    public $type = 'Тип';
    public $account_number = 'Учетный номер';
// address adding
    public $country = 'Страна, АТЕ, регион';
    public $region_local = 'Район (местный)';
    public $locality_local = 'Населенный пункт (местный)';
    public $street_local = 'Улица (местная)';
    public $region = 'Район';
    public $locality = 'Населенный пункт';
    public $street = 'Улица';
    public $track = 'Географическое место, трасса';
    public $home_num = 'Номер дома';
    public $housing_num = 'Номер корпуса';
    public $apt_num = 'Номер квартиры';
    public $start_living = 'Начало проживания (ДД.ММ.ГГ)';
    public $end_living = 'Конец проживания (ДД.ММ.ГГ)';
    public $data_period = 'Данные относятся к периоду';
    public $place_held = 'Является местом провед. действия, события';
    public $place_held_action = 'Является местом провед. действия';
    public $place_held_event = 'Является местом провед. события';
    public $place_person = 'Является местом жительства лица';
    public $address_organization = 'Адрес организации';
    public $seat_car = 'Является местом нахождения автомашины';
    public $dummy_address_organization = 'Подставной адрес организации';
// work_activity adding
    public $position = 'Должность';
    public $data_refer_period = 'Сведения относятся к периоду';
    public $start_employment = 'Дата начала трудовой деятельности';
    public $end_employment = 'Дата окончания трудовой деятельности';
    public $data_employment_persons = 'Данные о труд. деят. лица';
    public $jobs_organization = 'Работа в Организации';
    public $period = 'Сведения относятся к периоду';
// control adding
    public $unit = 'Подразделение';
    public $document_category ='Категория документа';
    public $document_date = 'Дата составления документа';
    public $reg_document = 'Рег. N документа';
    public $date_reg = 'Дата регистрации';
    public $director = 'Директор СНБ (ФИО)';
    public $deputy_director = 'Замдиректора СНБ (ФИО)';
    public $date_resolution = 'Дата резолюции';
    public $resolution = 'Резолюция';
    public $department_performer = 'Подразделение - ответств. исполнитель';
    public $actor_name = 'Фамилия исполнителя';
    public $sub_actor_name = 'Фамилия соисполнителя';
    public $department_coauthors = 'Подразделения - соисполнители';
    public $result_execution = 'Результат исполнения';
// objects_relation adding
    public $character_link = 'Характер связи';
    public $relation_type = 'Тип отношения';
    public $specific_link = 'Конкретная связь';
    public $first_object_type ='Тип первого объекта';
    public $second_object_type ='Тип второго объекта';
    public $first = 'Id: Первый';
    public $second = 'Id: Второй';
    public $relationship_objects_organization = 'Связь между объектами (Организация)';
    public $relationship_objects_man = 'Связь между объектами (Лицо)';
// external_signs adding
    public $photo = 'Фотография';
    public $signs = 'Приметы';
    public $time_fixation = 'Момент фиксации';
    public $man_sign = 'Внешние приметы относятся к лицу';
    public $thumbnail = 'Миниатюри';

// action adding
    public $content_materials_actions = 'Содержание материалов действия';
    public $qualification_fact = 'Квалификация  факта, признаки ПДП';
    public $start_action_date = 'Начальный момент действия (дата)';
    public $start_action_time = 'Начальный момент действия (время)';
    public $end_action_date = 'Конечный момент действия (дата)';
    public $end_action_time = 'Конечный момент действия (время)';
    public $duration_action = 'Продолжительность действия';
    public $purpose_motive_reason = 'Цель, мотив, причина совершения';
    public $terms_actions = 'Условия совершения действия';
    public $ensuing_effects = 'Наступившие (возможные) последствия';
    public $action_related_event = 'Данное действие связано с событием, действием';
    public $action_related_event_action = 'Данное действие связано с действием';
    public $action_related_event_event = 'Данное действие связано с событием';
    public $object_action = 'Обьект (участник) действия';
    public $object_action_man = 'Лицо (участник) действия';
    public $object_action_event = 'Событие (участник) действия';
    public $object_action_organization = 'Организация (участник) действия';
    public $object_action_phone = 'Телефон (участник) действия';
    public $object_action_weapon = 'Оружие (участник) действия';
    public $object_action_car = 'Автомашина (участник) действия';
    public $source_information_actions = 'Источник информации о действии';
    public $checking_signal = 'Проверяется как сигнал';
    public $opened_dou = 'Заведено ДОУ';
    public $place_action = 'Является местом проведения действия';
// event adding
    public $content_event = 'Содержание события';
    public $qualification_event = 'Квалификация события';
    public $date_security_date = 'Дата совершения СБ (дата)';
    public $date_security_time = 'Дата совершения СБ (время)';
    public $place_event_address = 'Место совершения события (адрес)';
    public $place_event_organization = 'Место совершения события (организация)';
    public $investigation_requested = 'Расследование поручено';
    public $results_event = 'Результат  расследования события';
    public $involved_events_man = 'Причаст. к событию (лицо)';
    public $involved_events_organization = 'Причаст. к событию (организация)';
    public $involved_events_car = 'Причаст. к событию (машина)';
    public $involved_events_weapon = 'Причаст. к событию (оружие)';
    public $involved_events_action = 'Причаст. к событию (действие)';
    public $source_event = 'Источник информации о событии';
    public $event_associated_action = 'Данное событие связано с действием';
// organization adding
    public $name_organization = 'Название организации';
    public $nation = 'Государственная принадлежность';
    public $date_formation= 'Дата образования (регистрации)';
    public $dislocation_organization = 'Дислокация орг., штаба, штаб-квартиры';
    public $region_activity = 'Регион деятельности';
    public $category_organization = 'Категория организации';
    public $security_organization = '<span style="font-size: 14px;">Подразделения СНБ, имеющие отношение к организации</span>';
    public $security_organization_for_grid = 'Подразделения СНБ, имеющие отношение к организации';
    public $number_worker = 'Численность сотруд. или членов';
    public $involved_the_events = 'Причастен к событию';
    public $relation_organization = 'Связь с другими организациями';
    public $description_organization = 'Краткое описание организации';
    public $dummy_address = 'Подставной адрес';
    public $organization_dow = 'На организацию заведено ДОУ';
    public $passes_criminal_case = 'Проходит по уголовному делу';
    public $object_actions = 'Объект действия';
    public $place_work_persons = 'Место работы ЛИЦА';
    public $checked_signal = 'Проверяется по сигналу';
    public $availability_car = 'Наличие автомашины';
    public $availability_weapons = 'Наличие оружия';
    public $place_event_is = 'Является местом совершения события';
//keep_signal
    public $management_signal = 'Управление, проверяющее сигнал';
    public $department_checking_signal = 'Отдел, проверяющий сигнал';
    public $unit_signal = 'Подразделение, проверявшее сигнал';
    public $name_operatives = 'Фамилия И.О. оперработника';
    public $worker_post = 'Должность оперработника';
    public $start_checking_signal = 'Начало проверки сигнала';
    public $end_checking_signal = 'Конец проверки сигнала';
    public $date_transfer_unit = 'Дата передачи в др. подразделение';
    public $unit_signal_transmitted = 'Подразделение, куда передан сигнал';
    public $refers_signal = 'Относится к сигналу';
//essay
    public $document_number = 'Номер документа';
    public $address_material = 'Адрес хранения материалов';
    public $information_regarding_person = 'Сведения относ. к ...';
    public $information_country = 'Сведения относятся к стране';
    public $name_subject = 'Наименование тематики';
    public $period_time = 'Свед. относ. к периоду времени';
    public $title_document = 'Заголовок документа';
    public $contents_document = 'Содержание документа';
//mia_summary
    public $date_registration_reports = 'Дата регистрации сводки';
    public $content_inf = 'Содержание инф-ии';
    public $summary_man_organizations = 'По сводке проходят лица, орг-ии';
    public $summary_man = 'По сводке проходят лица';
    public $summary_organizations = 'По сводке проходят орг-ии';
//criminal_case
    public $number_case = 'Номер дела';
    public $case_person = 'Дело относится к лицу';
    public $case_organization = 'Дело относится к организации';
    public $essence_material = 'Суть материалов';
    public $criminal_proceedings_date = 'Возбуждение уголовного дела (Дата)';
    public $criminal_code = 'Возбуждение уголовного дела. Статья УК';
    public $materials_management = 'Заведено по материалам Управления';
    public $head_department = 'Заведено по материалам отдела';
    public $instituted_units = 'Заведено по материалам подразделения';
    public $nature_materials_paint = 'Характер материалов (окраска)';
    public $instituted_fact = 'Заведено по факту (действие, событие)';
    public $instituted_fact_action = 'Заведено по факту (действие)';
    public $instituted_fact_event = 'Заведено по факту (событие)';
    public $results_inspection_signal = 'Возбуждено по результатам проверки сигнала';
    public $initiated_dow = 'Возбуждено по ДОУ';
    public $connected_criminal_cases = 'Соединено из уголовных дел';
    public $separated_criminal_cases = 'Выделено из уголовных дел';
//signal
    public $reg_number_signal = 'Рег. номер сигнальной карты';
    public $contents_information_signal = 'Содержание сигнальной информации';
    public $line_which_verified = 'Линия, по которой проверяется';
    public $check_status_charter = 'Состояние проверки к устан. сроку';
    public $qualifications_signaling = 'Квалификация сигнальной информации';
    public $source_category = 'Категория источника';
    public $checks_signal = 'Управление, проверяющее сигнал';
    public $department_checking = 'Отдел, проверяющий сигнал';
    public $unit_testing = 'Подразделение, проверявшее сигнал';
    public $name_checking_signal = 'ФИО о/р, проверяющего сигнал';
    public $date_registration_division = 'Дата постановки на учет в подразделении';
    public $check_date = 'Дата установленного срока проверки (D1)';
    public $check_previously = 'Дата ранее установ. срока проверки';
    public $date_actual = 'Дата фактического окончания проверки (D2)';
    public $date_actual_word = 'Дата фактического окончан проверки (D2)';
    public $amount_overdue = 'Количество просроч. дней закрытых сигналов';
    public $useful_capabilities = 'Используемые силы и средства';
    public $signal_results = 'Результаты  проверки';
    public $measures_taken = 'Принятые меры';
    public $according_result_dow = 'По результатам проверки заведено ДОУ';
    public $according_test_result = 'По рез. пров. возбуж. уголовное дело';
    public $objects_check_signal_man = 'Объекты проверки сигнала (лицо)';
    public $objects_check_signal_organization = 'Объекты проверки сигнала (организация)';
    public $objects_check_signal_action = 'Объекты проверки сигнала (действие)';
    public $objects_check_signal_event = 'Объекты проверки сигнала (событие)';
    public $brought_signal = 'Управление, которое завело сигнал';
    public $department_brought = 'Отдел, который завел сигнал';
    public $unit_brought = 'Подразделение, которое завело сигнал';
//man_bean_country
    public $purpose_visit = 'Цель въезда';
    public $country_ate = 'Страна, АТЕ';
    public $entry_date = 'Дата въезда';
    public $exit_date = 'Дата выезда';
    public $information_presence = 'Сведения о пребывании относ. к лицу';


// addTo
    public $face = 'Лицо';
    public $telephone = 'Телефон';
    public $weapon = 'Оружие';
    public $car = 'Автомашины';
    public $address = 'Адрес';
    public $work_activity = 'Трудовая деятельность';
    public $work_activity_2 = 'Трудовая деятельность';
    public $man_bean_country = 'Пребывание в стране';
    public $relationship_objects = 'Связь между объектами';
    public $action= 'Действие';
    public $event = 'Событие';
    public $organization = 'Организация';
    public $keep_signal = 'Ведение сигналов';
    public $user = 'Пользователь';

    public $work_activity_man = 'Трудовая деятельность (Лицо)';
    public $work_activity_organization = 'Трудовая деятельность (Организация)';

    public $essay = 'Реферат';
    public $control = 'Контроль';
    public $mia_summary = 'Сводка МВД';
    public $criminal = 'Уголовное дело';
    public $signal = 'Сигнал';
    public $email = 'Электронный адрес';

// dictionaries
    public $bodies_management = 'Органы управления';
    public $access_level = 'Уровень доступа';
    public $state_affiliation = 'Страна';
    public $languages = 'Языки';
    public $operational_category = 'Оперативная категория';
    public $educat = 'Образование';
    public $car_category = 'Категория машины';
    public $car_mark = 'Марка машины';
    public $purpose_of_visit = 'Цель въезда, мотив, причина, цель';
    public $purpose_action = 'Цель действий';
    public $qualifications_fact = 'Квалификация факта (таблица действие)';
    public $aftermath = 'Последствия';
    public $investigation_charged_worker = 'Расследование поручено, оперработник';
    public $test_results_signal = 'Результаты проверки (сигнал)';
    public $results_performance_control = 'Результаты исполнения (контроль)';

/////////////////////////////////
    public $start = 'Начинается с';
    public $equal = 'Равно';
    public $not_equal = 'Не равно';
    public $contains = 'Содержит';
    public $more = 'Больше';
    public $less = 'Меньше';
    public $more_equal = 'Больше и равно';
    public $less_equal = 'Меньше и равно';
    public $search_as = 'Искать как';
    public $seek = 'Искать';
    public $clean = 'Очистить';
    public $clean_all = 'Очистить фильтр';
    public $and = 'И';
    public $or = 'ИЛИ';
    public $view_ties = 'Посмотреть связи';
    public $add = 'Добавить';
    public $reg_number = 'Рег. номер';
    public $reg_date = 'Дата рег.';
    public $worker_name = 'Название работника';
    public $worker = 'Работника';
    public $created_at = 'Дата соз.';
    public $change_search = 'Изменить поиск';
    public $new_search = 'Новый поиск';
/////////////////////////////////////
    public $ties ='Связи';
    public $ties_action = 'Связи для действия с id=';
    public $ties_address = 'Связи для адреса с id=';
    public $ties_bibliography = 'Связи для библиографии с id=';
    public $ties_car = 'Связи для автомашины с id=';
    public $ties_control = 'Связи для контроль с id=';
    public $ties_criminal_case = 'Связи для уголовное дело с id=';
    public $ties_event = 'Связи для событие с id=';
    public $ties_keep_signal = 'Связи для Ведение сигналов с id=';
    public $ties_man = 'Связи для Лицо с id=';
    public $ties_man_bean_country = 'Связи для Пребывание в стране с id=';
    public $ties_mia_summary = 'Связи для Сводка МВД с id=';
    public $ties_objects_relation = 'Связи для Связь между объектами с id=';
    public $ties_organization = 'Связи для Организация с id=';
    public $ties_phone = 'Связи для Телефон с id=';
    public $ties_email = 'Связи для Электронный адрес с id=';
    public $ties_signal = 'Связи для Сигнал с id=';
    public $ties_weapon = 'Связи для Оружие с id=';
    public $ties_work_activity = 'Связи для Трудовая деятельность с id=';
    public $ties_external_signs = 'Связи для Внешние приметы с id=';

///////////////////////////// search //////////////////////////////////
    public $simple_search ='Простой поиск';
    public $complex_search ='Сложный поиск';
    public $template_search ='Поиск по шаблону';
    public $file_search = 'Поиск по файлам';
    public $file_in_search = 'Поиск в найденном';
    public $interval = "Интервал";
    public $started = "Заведенные";
    public $finished = "Прекращенные";
    public $active = "Действующие";
    public $report_search = "Отчет";
    public $report_search_signal = "Отчет по сигналам";

///////////////////////////////  short names ////////////////////////////

    public $short_man = 'ЛЦ';
    public $short_bibl = 'ББ';
    public $short_action = 'ДЕЙ';
    public $short_event = 'СОБ';
    public $short_organ = 'ОРГ';
    public $short_address = 'АДР';
    public $short_keep_signal = 'ВВ.СИГ';
    public $short_external_sign = 'ВН.ПР';
    public $short_bean_country = 'ПРБ.СТ';
    public $short_work_activity = 'ТР.Д';
    public $short_object = 'СВЯЗ';
    public $short_control = 'КОН';
    public $short_phone = 'ТЕЛ';
    public $short_email = 'МАИЛ';
    public $short_signal = 'СИГ';
    public $short_criminal = 'УГ';
    public $short_car = 'МАШ';
    public $short_weapon = 'ОРУ';
    public $short_mia = 'МВД';

    /////////////////////////////////////////
    public $face_has = 'Принадлежит лицу';
    public $face_use = 'Находится у лица';

    //user add
    public $add_user = 'Добавить пользователя';
    public $user_name = 'Имя пользователя';
    public $password = 'Пароль';
    public $login = 'Вход';
    public $repeat_password = 'Повторите пароль';
    public $type_admin  = 'Администратор';
    public $type_editor = 'Редактор';
    public $type_viewer = 'Только просмотр';
    public $user_list = 'Список пользователей';
    public $save = 'Сохранить';
    public $user_edit = 'Редактирование пользователя';


    //////   admin  ///////
    public $mysql_backup = 'Копирование базы' ;
    public $mysql_import = 'Восстановление базы';
    public $optimization = 'Оптимизация';
    public $fusion = 'Слить данные';
    public $logging = 'Запись (журнал)';

    //Слитые

    public $first_id = 'Первое';
    public $second_id =  'Второе';
    public $start_fusion = 'Слить данные';
    public $empty = 'Оставить пустым';
    public $read_more = 'Читать далее...';
    public $operation = 'Действие';
    public $table_name = 'Имя таблицы';

    //loging
    public $logging_login = 'Вход';
    public $logging_logout = 'Выход';
    public $logging_add = 'Добавление';
    public $logging_adv_search = 'Сложный поиск';
    public $logging_backup = 'Копирование базы';
    public $logging_delete = 'Удаление';
    public $logging_edit = 'Редактирование';
    public $logging_file_search = 'Поиск по файлам';
    public $logging_fusion = 'Слить данные';
    public $logging_print = 'Печать';
    public $logging_print_joins = 'Печать с связями';
    public $logging_report = 'Квартальный отчет';
    public $logging_restore = 'Восстановление базы';
    public $logging_search_template = 'Поиск по шаблону';
    public $logging_smp_search = 'Простой поиск';
    public $logging_view = 'Просмотр';

   //signal_report
    public $signal_0 = 'П/Н';
    public $signal_1 = 'Подразделение, проверяющее СГ';
    public $signal_2 = 'Оперработник, проверяющ. СГ';
    public $signal_3 = 'Должность';
    public $signal_4 = 'Рег.н.';
    public $signal_5 = 'Окраска сигнала';
    public $signal_6 = 'Категории источн. инф.';
    public $signal_7 = 'Дата заведен.';
    public $signal_8 = 'Налич. продл.';
    public $signal_9 = 'Срок проверки';
    public $signal_10 = 'Дата закрыт.';
    public $signal_11 = 'Пр. дни';
    public $signal_12 = 'Результаты проверки';
    public $signal_13 = 'Принятые меры';



    //////////////////////////   add rus,arm    //////////////////////
    public $enter_number = 'Введите правильное число';
    public $enter_qualification = 'Введите правильную квалификацию';
    public $enter_duration = 'Введите правильную продолжительность';
    public $enter_motive = 'Введите правильный мотив';
    public $enter_condition = 'Введите правильное условие';
    public $enter_outcome = 'Введите правильное последствие';
    public $enter_anything = 'Вы ничего не ввели.';
    public $delete_entry = 'Удалить запись ?';
    public $enter_field = 'Введите обязательное поле';
    public $break_link = 'Вы уверены, что хотите разорвать связь ?';
    public $relationship_exists = 'Эта связь уже существует';
    public $enter_country = 'Введите правильную страну';
    public $enter_region = 'Введите правильный регион';
    public $enter_locality = 'Введите правильный населеный пункт';
    public $enter_street = 'Введите правильную улицу';
    public $enter_category = 'Введите правильную категорию';
    public $enter_mark = 'Введите правильную марку';
    public $enter_department = 'Введите правильное подразделение';
    public $enter_result = 'Введите правильный результат';
    public $enter_agency = 'Введите правильное агенство';
    public $email_quit = 'Вы не ввели e-mail, хотите выйти ?';
    public $enter_email = 'Введите правильный e-mail';
    public $enter_source = 'Введите правильный источник';
    public $enter_date_time = 'Введите правильную дату или время';
    public $enter_sign = 'Введите правильную примету';
    public $sign_quit = 'Вы не ввели примету, хотите выйти ?';
    public $image_upload = 'Изображения только с GIF, JPG или PNG расширения могут быть загружены!';
    public $enter_gender = 'Введите правильный пол';
    public $enter_resource = 'Введите правильный ресурс';
    public $enter_nation = ' Введите правильную национальность';
    public $enter_religion = 'Введите правильную религию';
    public $country_quit ='Вы не ввели страну, хотите выйти ?';
    public $must_fill_field = 'Вы должны заполнить все поля';
    public $enter_organ = 'Введите правильный орган';
    public $phone_quit ='Вы не ввели телефон, хотите выйти ?';
    public $enter_worker = 'Введите правильного работника';
    public $face_quit = 'Вы не выбрали Лицо, хотите выйти?';
    public $organization_quit = 'Вы не выбрали Организацию, хотите выйти?';
    public $enter_level = 'Введите правильный уровень';
    public $error = 'Произошла ошибка попробуйте еще раз';
    public $err = 'Ошибка!';

    /////////////////  autocomplete arm, rus  /////////////////////
    public $filtr = 'Фильтр';
    public $enter_name = 'Пожалуйста введите название';
    public $city = 'Город';
    public $enter_the_name = 'Введите Имя';
    public $enter_the_last_name = 'Введите Фамилие';
    public $enter_post = 'Введите должность';
    public $take = 'Принять';
    public $only_txt = 'Только файлы с txt расширением';
    public $no_link = 'Нет связей';
    public $are_you_sure = 'Вы уверены ?';
    public $delete_account = ' что хотите удалить запись ?';
    public $dictionary = 'Словарь с ';
    public $no_id = ' id нет';
    public $enter_correct = 'Введите правильно';

    ////////////////  advancedsearch  rus, arm   /////////////
    public $person_found = 'Лицо не найдено';
    public $man_bean_country_found = 'Пребывание в стране не найдено';
    public $bibliography_found = 'Библиография не найдено';
    public $face_found = 'Лицо не найдено';
    public $organization_found = 'Организация не найдено';
    public $weapon_found = 'Оружие не найдено';
    public $car_found = 'Автомашина не найдено';
    public $phone_found = 'Телефон не найдено';
    public $address_found = 'Адрес не найдено';
    public $signal_found = 'Сигнал не найдено';
    public $criminal_found = 'Уг. дело не найдено';
    public $event_found = 'Событие не найдено';
    public $action_found = 'Действие не найдено';
    public $control_found = 'Контроль не найдено';
    public $mia_summary_found = 'Сводка МВД не найдено';
    public $email_found = 'Email не найдено';
    public $sign_found = 'Внешные приметы не найдено';
    public $keep_signal_found = 'Ведение сигналов не найдено';
    public $objects_found = 'Связь между объектами не найдено';
    public $work_activity_found = 'Трудовая деятельность не найдено';

    /////////////////////   admin arm, rus    //////////////////////
    public $fill_field = 'Заполните все поля';
    public $invalid_password = 'Неверный пароль';

    public $word = 'Ворд';
    public $delete = 'Удалить';

    public $upload = "Загрузить";

    public $file_delete = ', что хотите удалить файл ?';

    public $by_date = 'По дате';
    public $by_agency = 'По управлению';

    // FOR REPORT

    public $report_1 = 'Подразделение, которое завело сигнал';
    public $report_2 = 'Фамилия оперработника';
    public $report_3 = 'должность оперработника';
    public $report_4 = 'Рег. №';
    public $report_5 = 'Окраска сигнала';
    public $report_6 = 'Категории источн. инф.';
    public $report_7 = 'Дата заведен.';

    public $report2_1  = 'Подразделение, проверяющее СГ';
    public $report2_2  = 'Оперработник, проверяющ. СГ';
    public $report2_3  = 'долж- ность';
    public $report2_4  = 'Рег. №';
    public $report2_5  = 'Окраска сигнала';
    public $report2_6  = 'Категории источн. инф.';
    public $report2_7  = 'Дата заведен.';
    public $report2_8  = 'Налич. продл.';
    public $report2_9  = 'Срок проверки';
    public $report2_10 = 'Дата закрыт.';
    public $report2_11 = 'Пр. дни';
    public $report2_12 = 'Результаты проверки';
    public $report2_13 = 'Принятые меры';

    public $big = '(полный)';
    public $short = '(краткий)';

    public $quarter = 'квартал';
    public $year = 'год';
    public $half_year = 'полугодие';

    public $sgq = 'по окраскам';

    public $help = "Помощь";
    public $help_1 = "При поиске слов не использовать символ '*'";
    public $help_2 = "Поиск по принципу И : между словами ставим + (слова надо писать с точными окончаниями).";
    public $help_3 = "Поиск по принципу ИЛИ : между словами ставим [пробел] и можем использовать ‘*’.";
    public $help_4 = "Поиск номера телефона (сотового или домашнего): пишем подряд 9 или 6 цифр, соответственно, без пробелов и каких-либо знаков (результат не 100%).";
    public $help_5 = "Поиск по символам начинать со знака ‘~’.";

    public $show = 'Показать всех';
    public $hide = 'Скрыть';

    public $video = 'Наличие видео';

    public $short_photo = "Фото";
    public $short_video = "Видео";
}
