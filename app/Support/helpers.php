<?php

use App\Support\Constants;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Data\Repositories\Buildings;

function only_letters_and_space($string)
{
    return preg_replace('/([^a-zA-Z\s])/', '', $string);
}

function startTimer()
{
    Timer::$starttime = microtime(true);
}

function endTimer()
{
    Timer::$endtime = microtime(true);

    return Timer::$endtime - Timer::$starttime;
}

if (!function_exists('studly')) {
    /**
     * Convert a value to studly caps case.
     *
     * @param  string $value
     * @return string
     */
    function studly($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return str_replace(' ', '', $value);
    }
}

function toBoolean($boolean)
{
    return $boolean === 'true' || $boolean === '1' || $boolean === 1 || $boolean === true;
}

function only_numbers($string)
{
    return preg_replace('/\D/', '', $string);
}

function remove_punctuation($string)
{
    return preg_replace('/[^a-z0-9]+/i', '', $string);
}

function ld($info)
{
    info($info);
    die();
}

function make_pdf_filename($baseName)
{
    return Str::slug($baseName . ' ' . now()->format('Y m d H i')) . '.pdf';
}

function make_filename($baseName, $extension)
{
    return Str::slug($baseName . ' ' . now()->format('Y m d H i')) . '.' . $extension;
}

function current_user()
{
    return auth()->user();
}

function unnacent($string)
{
    $table = [
        'Š' => 'S',
        'š' => 's',
        'Đ' => 'Dj',
        'đ' => 'dj',
        'Ž' => 'Z',
        'ž' => 'z',
        'Č' => 'C',
        'č' => 'c',
        'Ć' => 'C',
        'ć' => 'c',
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'A',
        'Å' => 'A',
        'Æ' => 'A',
        'Ç' => 'C',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ñ' => 'N',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'O',
        'Ø' => 'O',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ý' => 'Y',
        'Þ' => 'B',
        'ß' => 'Ss',
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'a',
        'å' => 'a',
        'æ' => 'a',
        'ç' => 'c',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ð' => 'o',
        'ñ' => 'n',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',
        'ø' => 'o',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ý' => 'y',
        'þ' => 'b',
        'ÿ' => 'y',
        'Ŕ' => 'R',
        'ŕ' => 'r',
    ];

    return strtr($string, $table);
}

function make_slug($string)
{
    return Str::slug(unnacent($string));
}

function capitalizeBrazilian($name)
{
    $string = mb_convert_case($name, MB_CASE_TITLE);

    $string = trim(preg_replace('/\s\s+/', ' ', $string));

    coollect(['de', 'da', 'do', 'das', 'dos', 'e'])->each(function ($exception) use (&$string) {
        $exception = mb_convert_case($exception, MB_CASE_TITLE);

        $newCase = mb_convert_case($exception, MB_CASE_LOWER);

        $string = str_replace(" {$exception} ", " {$newCase} ", $string);

        preg_match_all('/(.\'.)/ui', $string, $matched);

        if (isset($matched[0])) {
            coollect($matched[0])->each(function ($match) use (&$string) {
                $newCase = mb_convert_case($match, MB_CASE_UPPER);

                $string = str_replace(substr($match, 1), substr($newCase, 1), $string);
            });
        }
    });

    return $string;
}

function to_upper($string)
{
    return convert_case($string, MB_CASE_UPPER);
}

function permission_slug($string)
{
    $string = str_replace(':', $replace = 'xxxxxxxxxx', $string);

    return str_replace($replace, ':', Str::slug($string));
}

function to_reais($number)
{
    return 'R$ ' . number_format($number, 2, ',', '.');
}

function without_reais($number)
{
    return str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $number)));
}

function trunc_value_with_two_digits($number)
{
    return intval($number * 100) / 100;
}

function db_listen($dump = false)
{
    \DB::listen(function ($query) use ($dump) {
        \Log::info($query->sql);
        \Log::info($query->bindings);

        if ($dump) {
            dump($query->sql);
            dump($query->bindings);
        }
    });
}

function faker()
{
    return \Faker\Factory::create('pt_BR');
}

function in($needle, ...$haystack): bool
{
    foreach ($haystack as $hay) {
        if ((is_array($hay) && in($needle, ...$hay)) || $needle == $hay) {
            return true;
        }
    }

    return false;
}

function nin($needle, ...$haystack): bool
{
    return !in($needle, ...$haystack);
}

function allows($ability)
{
    if (!($can = \Illuminate\Support\Facades\Gate::allows($ability))) {
        //    if (!$can = auth()->user()->can($ability)) {
        info(
            sprintf(
                'User [%s, %s] is not permitted to do %s',
                auth()->user()->name,
                auth()->user()->email,
                collect($ability)->implode(', ')
            )
        );
    }

    return $can;
}

function make_deep_path($nameHash, $length = 4)
{
    $deepPath = '';

    for ($i = 1; $i <= $length; $i++) {
        $deepPath = $deepPath . substr($nameHash, $i - 1, 1) . DIRECTORY_SEPARATOR;
    }

    return $deepPath;
}

function formMode($mode = null)
{
    return $mode
        ? session()->flash(Constants::SESSION_FORM_MODE, $mode)
        : session(Constants::SESSION_FORM_MODE, Constants::FORM_MODE_SHOW);
}

function is_at_least_verbose($command)
{
    return $command->getOutput()->getVerbosity() >=
        \Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERBOSE;
}

function is_br_date($date)
{
    try {
        $date = Carbon::createFromFormat('d/m/Y', $date);
    } catch (\InvalidArgumentException $e) {
        //Not a date
        return false;
    }
    return true;
}

function mask_zipcode($zipcode)
{
    return preg_replace('/(\d\d\d\d\d)(\d\d\d)/', '$1-$2', $zipcode);
}

function mask_cpf($cpf)
{
    return preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $cpf);
}

function login_as_system()
{
    return app(\App\Data\Repositories\Users::class)->loginAsSystem();
}

function to_sql_with_bindings($query)
{
    return vsprintf(
        str_replace('?', '%s', $query->toSql()),
        collect($query->getBindings())
            ->map(function ($binding) {
                return is_numeric($binding) ? $binding : "'{$binding}'";
            })
            ->toArray()
    );
}

class Timer
{
    public static $starttime;
    public static $endtime;
}

function validate_cpf($string)
{
    return Validator::make(
        ['string' => (string) $string],
        [
            'string' => 'required|cpf',
        ]
    )->passes();
}

function mask_protocol_number($protocol_number)
{
    $ano = substr($protocol_number, 0, 4);
    $codigo = substr($protocol_number, 4, 4);

    return $codigo . '/' . $ano;
}

function access_token()
{
    return session()->get('access-token');
}
function protocol_number_masked_to_bigint($protocol_number_masked)
{
    $protocol_number = only_numbers($protocol_number_masked);

    $codigo = substr($protocol_number, 0, 4);
    $ano = substr($protocol_number, 4, 4);

    return $ano . $codigo;
}

function mount_text($txt)
{
    return substr($txt, 0, 120);
}

function mount_css_text($txt)
{
    if (strlen($txt) <= 100) {
        return 'badge-font-size-11';
    } elseif (strlen($txt) <= 110) {
        return 'badge-font-size-10';
    } else {
        return 'badge-font-size-9';
    }
}

function no_photo()
{
    return '/img/no-photo.svg';
}

function no_photo_table()
{
    return '/img/no-photo-table.svg';
}

function mime2ext($mime)
{
    $mime_map = [
        'video/3gpp2' => '3g2',
        'video/3gp' => '3gp',
        'video/3gpp' => '3gp',
        'application/x-compressed' => '7zip',
        'audio/x-acc' => 'aac',
        'audio/ac3' => 'ac3',
        'application/postscript' => 'ai',
        'audio/x-aiff' => 'aif',
        'audio/aiff' => 'aif',
        'audio/x-au' => 'au',
        'video/x-msvideo' => 'avi',
        'video/msvideo' => 'avi',
        'video/avi' => 'avi',
        'application/x-troff-msvideo' => 'avi',
        'application/macbinary' => 'bin',
        'application/mac-binary' => 'bin',
        'application/x-binary' => 'bin',
        'application/x-macbinary' => 'bin',
        'image/bmp' => 'bmp',
        'image/x-bmp' => 'bmp',
        'image/x-bitmap' => 'bmp',
        'image/x-xbitmap' => 'bmp',
        'image/x-win-bitmap' => 'bmp',
        'image/x-windows-bmp' => 'bmp',
        'image/ms-bmp' => 'bmp',
        'image/x-ms-bmp' => 'bmp',
        'application/bmp' => 'bmp',
        'application/x-bmp' => 'bmp',
        'application/x-win-bitmap' => 'bmp',
        'application/cdr' => 'cdr',
        'application/coreldraw' => 'cdr',
        'application/x-cdr' => 'cdr',
        'application/x-coreldraw' => 'cdr',
        'image/cdr' => 'cdr',
        'image/x-cdr' => 'cdr',
        'zz-application/zz-winassoc-cdr' => 'cdr',
        'application/mac-compactpro' => 'cpt',
        'application/pkix-crl' => 'crl',
        'application/pkcs-crl' => 'crl',
        'application/x-x509-ca-cert' => 'crt',
        'application/pkix-cert' => 'crt',
        'text/css' => 'css',
        'text/x-comma-separated-values' => 'csv',
        'text/comma-separated-values' => 'csv',
        'application/vnd.msexcel' => 'csv',
        'application/x-director' => 'dcr',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
        'application/x-dvi' => 'dvi',
        'message/rfc822' => 'eml',
        'application/x-msdownload' => 'exe',
        'video/x-f4v' => 'f4v',
        'audio/x-flac' => 'flac',
        'video/x-flv' => 'flv',
        'image/gif' => 'gif',
        'application/gpg-keys' => 'gpg',
        'application/x-gtar' => 'gtar',
        'application/x-gzip' => 'gzip',
        'application/mac-binhex40' => 'hqx',
        'application/mac-binhex' => 'hqx',
        'application/x-binhex40' => 'hqx',
        'application/x-mac-binhex40' => 'hqx',
        'text/html' => 'html',
        'image/x-icon' => 'ico',
        'image/x-ico' => 'ico',
        'image/vnd.microsoft.icon' => 'ico',
        'text/calendar' => 'ics',
        'application/java-archive' => 'jar',
        'application/x-java-application' => 'jar',
        'application/x-jar' => 'jar',
        'image/jp2' => 'jp2',
        'video/mj2' => 'jp2',
        'image/jpx' => 'jp2',
        'image/jpm' => 'jp2',
        'image/jpeg' => 'jpeg',
        'image/pjpeg' => 'jpeg',
        'application/x-javascript' => 'js',
        'application/json' => 'json',
        'text/json' => 'json',
        'application/vnd.google-earth.kml+xml' => 'kml',
        'application/vnd.google-earth.kmz' => 'kmz',
        'text/x-log' => 'log',
        'audio/x-m4a' => 'm4a',
        'audio/mp4' => 'm4a',
        'application/vnd.mpegurl' => 'm4u',
        'audio/midi' => 'mid',
        'application/vnd.mif' => 'mif',
        'video/quicktime' => 'mov',
        'video/x-sgi-movie' => 'movie',
        'audio/mpeg' => 'mp3',
        'audio/mpg' => 'mp3',
        'audio/mpeg3' => 'mp3',
        'audio/mp3' => 'mp3',
        'video/mp4' => 'mp4',
        'video/mpeg' => 'mpeg',
        'application/oda' => 'oda',
        'audio/ogg' => 'ogg',
        'video/ogg' => 'ogg',
        'application/ogg' => 'ogg',
        'font/otf' => 'otf',
        'application/x-pkcs10' => 'p10',
        'application/pkcs10' => 'p10',
        'application/x-pkcs12' => 'p12',
        'application/x-pkcs7-signature' => 'p7a',
        'application/pkcs7-mime' => 'p7c',
        'application/x-pkcs7-mime' => 'p7c',
        'application/x-pkcs7-certreqresp' => 'p7r',
        'application/pkcs7-signature' => 'p7s',
        'application/pdf' => 'pdf',
        'application/octet-stream' => 'pdf',
        'application/x-x509-user-cert' => 'pem',
        'application/x-pem-file' => 'pem',
        'application/pgp' => 'pgp',
        'application/x-httpd-php' => 'php',
        'application/php' => 'php',
        'application/x-php' => 'php',
        'text/php' => 'php',
        'text/x-php' => 'php',
        'application/x-httpd-php-source' => 'php',
        'image/png' => 'png',
        'image/x-png' => 'png',
        'application/powerpoint' => 'ppt',
        'application/vnd.ms-powerpoint' => 'ppt',
        'application/vnd.ms-office' => 'ppt',
        'application/msword' => 'doc',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        'application/x-photoshop' => 'psd',
        'image/vnd.adobe.photoshop' => 'psd',
        'audio/x-realaudio' => 'ra',
        'audio/x-pn-realaudio' => 'ram',
        'application/x-rar' => 'rar',
        'application/rar' => 'rar',
        'application/x-rar-compressed' => 'rar',
        'audio/x-pn-realaudio-plugin' => 'rpm',
        'application/x-pkcs7' => 'rsa',
        'text/rtf' => 'rtf',
        'text/richtext' => 'rtx',
        'video/vnd.rn-realvideo' => 'rv',
        'application/x-stuffit' => 'sit',
        'application/smil' => 'smil',
        'text/srt' => 'srt',
        'image/svg+xml' => 'svg',
        'application/x-shockwave-flash' => 'swf',
        'application/x-tar' => 'tar',
        'application/x-gzip-compressed' => 'tgz',
        'image/tiff' => 'tiff',
        'font/ttf' => 'ttf',
        'text/plain' => 'txt',
        'text/x-vcard' => 'vcf',
        'application/videolan' => 'vlc',
        'text/vtt' => 'vtt',
        'audio/x-wav' => 'wav',
        'audio/wave' => 'wav',
        'audio/wav' => 'wav',
        'application/wbxml' => 'wbxml',
        'video/webm' => 'webm',
        'image/webp' => 'webp',
        'audio/x-ms-wma' => 'wma',
        'application/wmlc' => 'wmlc',
        'video/x-ms-wmv' => 'wmv',
        'video/x-ms-asf' => 'wmv',
        'font/woff' => 'woff',
        'font/woff2' => 'woff2',
        'application/xhtml+xml' => 'xhtml',
        'application/excel' => 'xl',
        'application/msexcel' => 'xls',
        'application/x-msexcel' => 'xls',
        'application/x-ms-excel' => 'xls',
        'application/x-excel' => 'xls',
        'application/x-dos_ms_excel' => 'xls',
        'application/xls' => 'xls',
        'application/x-xls' => 'xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
        'application/vnd.ms-excel' => 'xlsx',
        'application/xml' => 'xml',
        'text/xml' => 'xml',
        'text/xsl' => 'xsl',
        'application/xspf+xml' => 'xspf',
        'application/x-compress' => 'z',
        'application/x-zip' => 'zip',
        'application/zip' => 'zip',
        'application/x-zip-compressed' => 'zip',
        'application/s-compressed' => 'zip',
        'multipart/x-zip' => 'zip',
        'text/x-scriptzsh' => 'zsh',
    ];
    return isset($mime_map[$mime]) ? $mime_map[$mime] : false;
}

function get_current_building_id()
{
    return session()->get('building_id') ?? app(Buildings::class)->getMainBuilding()->id;
}
function convert_case($text, $type)
{
    return is_null($text) ? $text : mb_convert_case($text, $type);
}
