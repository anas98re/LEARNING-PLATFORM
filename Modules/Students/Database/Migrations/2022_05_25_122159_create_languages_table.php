<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->text('language_code') ; 
            $table->text('language_name') ;             
        });

    }


/*
for seeding this table run this command in mysql 

INSERT INTO `languages` (`id`, `language_code`, `language_name`) VALUES
(1, 'af', 'Afrikaans'),
(2, 'sq', 'Albanian - shqip'),
(3, 'am', 'Amharic - አማርኛ'),
(4, 'ar', 'Arabic - العربية'),
(5, 'an', 'Aragonese - aragonés'),
(6, 'hy', 'Armenian - հայերեն'),
(7, 'ast', 'Asturian - asturianu'),
(8, 'az', 'Azerbaijani - azərbaycan dili'),
(9, 'eu', 'Basque - euskara'),
(10, 'be', 'Belarusian - беларуская'),
(11, 'bn', 'Bengali - বাংলা'),
(12, 'bs', 'Bosnian - bosanski'),
(13, 'br', 'Breton - brezhoneg'),
(14, 'bg', 'Bulgarian - български'),
(15, 'ca', 'Catalan - català'),
(16, 'ckb', 'Central Kurdish - کوردی (دەستنوسی عەرەبی)'),
(17, 'zh', 'Chinese - 中文'),
(18, 'zh-HK', 'Chinese (Hong Kong) - 中文（香港）'),
(19, 'zh-CN', 'Chinese (Simplified) - 中文（简体）'),
(20, 'zh-TW', 'Chinese (Traditional) - 中文（繁體）'),
(21, 'co', 'Corsican'),
(22, 'hr', 'Croatian - hrvatski'),
(23, 'cs', 'Czech - čeština'),
(24, 'da', 'Danish - dansk'),
(25, 'nl', 'Dutch - Nederlands'),
(26, 'en', 'English'),
(27, 'en-AU', 'English (Australia)'),
(28, 'en-CA', 'English (Canada)'),
(29, 'en-IN', 'English (India)'),
(30, 'en-NZ', 'English (New Zealand)'),
(31, 'en-ZA', 'English (South Africa)'),
(32, 'en-GB', 'English (United Kingdom)'),
(33, 'en-US', 'English (United States)'),
(34, 'eo', 'Esperanto - esperanto'),
(35, 'et', 'Estonian - eesti'),
(36, 'fo', 'Faroese - føroyskt'),
(37, 'fil', 'Filipino'),
(38, 'fi', 'Finnish - suomi'),
(39, 'fr', 'French - français'),
(40, 'fr-CA', 'French (Canada) - français (Canada)'),
(41, 'fr-FR', 'French (France) - français (France)'),
(42, 'fr-CH', 'French (Switzerland) - français (Suisse)'),
(43, 'gl', 'Galician - galego'),
(44, 'ka', 'Georgian - ქართული'),
(45, 'de', 'German - Deutsch'),
(46, 'de-AT', 'German (Austria) - Deutsch (Österreich)'),
(47, 'de-DE', 'German (Germany) - Deutsch (Deutschland)'),
(48, 'de-LI', 'German (Liechtenstein) - Deutsch (Liechtenstein)'),
(49, 'de-CH', 'German (Switzerland) - Deutsch (Schweiz)'),
(50, 'el', 'Greek - Ελληνικά'),
(51, 'gn', 'Guarani'),
(52, 'gu', 'Gujarati - ગુજરાતી'),
(53, 'ha', 'Hausa'),
(54, 'haw', 'Hawaiian - ʻŌlelo Hawaiʻi'),
(55, 'he', 'Hebrew - עברית'),
(56, 'hi', 'Hindi - हिन्दी'),
(57, 'hu', 'Hungarian - magyar'),
(58, 'is', 'Icelandic - íslenska'),
(59, 'id', 'Indonesian - Indonesia'),
(60, 'ia', 'Interlingua'),
(61, 'ga', 'Irish - Gaeilge'),
(62, 'it', 'Italian - italiano'),
(63, 'it-IT', 'Italian (Italy) - italiano (Italia)'),
(64, 'it-CH', 'Italian (Switzerland) - italiano (Svizzera)'),
(65, 'ja', 'Japanese - 日本語'),
(66, 'kn', 'Kannada - ಕನ್ನಡ'),
(67, 'kk', 'Kazakh - қазақ тілі'),
(68, 'km', 'Khmer - ខ្មែរ'),
(69, 'ko', 'Korean - 한국어'),
(70, 'ku', 'Kurdish - Kurdî'),
(71, 'ky', 'Kyrgyz - кыргызча'),
(72, 'lo', 'Lao - ລາວ'),
(73, 'la', 'Latin'),
(74, 'lv', 'Latvian - latviešu'),
(75, 'ln', 'Lingala - lingála'),
(76, 'lt', 'Lithuanian - lietuvių'),
(77, 'mk', 'Macedonian - македонски'),
(78, 'ms', 'Malay - Bahasa Melayu'),
(79, 'ml', 'Malayalam - മലയാളം'),
(80, 'mt', 'Maltese - Malti'),
(81, 'mr', 'Marathi - मराठी'),
(82, 'mn', 'Mongolian - монгол'),
(83, 'ne', 'Nepali - नेपाली'),
(84, 'no', 'Norwegian - norsk'),
(85, 'nb', 'Norwegian Bokmål - norsk bokmål'),
(86, 'nn', 'Norwegian Nynorsk - nynorsk'),
(87, 'oc', 'Occitan'),
(88, 'or', 'Oriya - ଓଡ଼ିଆ'),
(89, 'om', 'Oromo - Oromoo'),
(90, 'ps', 'Pashto - پښتو'),
(91, 'fa', 'Persian - فارسی'),
(92, 'pl', 'Polish - polski'),
(93, 'pt', 'Portuguese - português'),
(94, 'pt-BR', 'Portuguese (Brazil) - português (Brasil)'),
(95, 'pt-PT', 'Portuguese (Portugal) - português (Portugal)'),
(96, 'pa', 'Punjabi - ਪੰਜਾਬੀ'),
(97, 'qu', 'Quechua'),
(98, 'ro', 'Romanian - română'),
(99, 'mo', 'Romanian (Moldova) - română (Moldova)'),
(100, 'rm', 'Romansh - rumantsch'),
(101, 'ru', 'Russian - русский'),
(102, 'gd', 'Scottish Gaelic'),
(103, 'sr', 'Serbian - српски'),
(104, 'sh', 'Serbo-Croatian - Srpskohrvatski'),
(105, 'sn', 'Shona - chiShona'),
(106, 'sd', 'Sindhi'),
(107, 'si', 'Sinhala - සිංහල'),
(108, 'sk', 'Slovak - slovenčina'),
(109, 'sl', 'Slovenian - slovenščina'),
(110, 'so', 'Somali - Soomaali'),
(111, 'st', 'Southern Sotho'),
(112, 'es', 'Spanish - español'),
(113, 'es-AR', 'Spanish (Argentina) - español (Argentina)'),
(114, 'es-419', 'Spanish (Latin America) - español (Latinoamérica)'),
(115, 'es-MX', 'Spanish (Mexico) - español (México)'),
(116, 'es-ES', 'Spanish (Spain) - español (España)'),
(117, 'es-US', 'Spanish (United States) - español (Estados Unidos)'),
(118, 'su', 'Sundanese'),
(119, 'sw', 'Swahili - Kiswahili'),
(120, 'sv', 'Swedish - svenska'),
(121, 'tg', 'Tajik - тоҷикӣ'),
(122, 'ta', 'Tamil - தமிழ்'),
(123, 'tt', 'Tatar'),
(124, 'te', 'Telugu - తెలుగు'),
(125, 'th', 'Thai - ไทย'),
(126, 'ti', 'Tigrinya - ትግርኛ'),
(127, 'to', 'Tongan - lea fakatonga'),
(128, 'tr', 'Turkish - Türkçe'),
(129, 'tk', 'Turkmen'),
(130, 'tw', 'Twi'),
(131, 'uk', 'Ukrainian - українська'),
(132, 'ur', 'Urdu - اردو'),
(133, 'ug', 'Uyghur'),
(134, 'uz', 'Uzbek - o‘zbek'),
(135, 'vi', 'Vietnamese - Tiếng Việt'),
(136, 'wa', 'Walloon - wa'),
(137, 'cy', 'Welsh - Cymraeg'),
(138, 'fy', 'Western Frisian'),
(139, 'xh', 'Xhosa'),
(140, 'yi', 'Yiddish'),
(141, 'yo', 'Yoruba - Èdè Yorùbá'),
(142, 'zu', 'Zulu - isiZulu');


*/


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
};
