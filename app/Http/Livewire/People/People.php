<?php

namespace App\Http\Livewire\People;

use App\Data\Repositories\Countries;
use App\Data\Repositories\Documents;
use App\Data\Repositories\DocumentTypes;
use App\Data\Repositories\PersonRestrictions as PersonRestrictionsRepository;
use App\Data\Repositories\States;
use App\Http\Livewire\BaseForm;
use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use App\Models\Person;
use App\Http\Livewire\Traits\WithWebcam;
use App\Models\Visitor;
use Illuminate\Support\MessageBag;
use Livewire\WithFileUploads;

use function app;
use function info;
use function view;

class People extends BaseForm
{
    use WithFileUploads;
    use WithWebcam;

    protected $listeners = [
        'snapshotTaken' => 'updatePJFile',
        'cropChanged' => 'cropChanged',
    ];

    public $countryBr;
    public $countryBrSelected;

    public $person;
    public $person_id;
    public $document_number;
    public $full_name;
    public $social_name;
    public $country_id;
    public $state_id;
    public $city_id;
    public $other_city;
    public $document_type_id;

    public $cities = [];

    public $origin;
    public $routineStatus;
    public $modal;
    public $readonly;
    public $showRestrictions = false;
    public $alerts = [];

    public $visitor_id;

    public $visitor;

    protected $rules=
        [
          'countryBr'=>'',
          'country_id'=>'',
          'city_id'=>'',
          'state_id'=>'',
        ];

    //    public function searchCpf()
    //    {
    //        try {
    //            $this->resetErrorBag('cpf');
    //            $this->alerts = [];
    //
    //            if (!validate_cpf(only_numbers($this->cpf))) {
    //                $this->person_id = null;
    //                $this->full_name = null;
    //                $this->origin = null;
    //
    //                $this->addError('cpf', 'CPF não encontrado');
    //            } elseif ($result = app(PeopleRepository::class)->findByCpf(only_numbers($this->cpf))) {
    //                $this->person_id = $result['id'];
    //                $this->full_name = $result['full_name'];
    //                $this->origin = $result['origin'];
    //
    //                if ($this->showRestrictions) {
    //                    $restrictions = app(PersonRestrictionsRepository::class)->getRestrictions(
    //                        only_numbers($this->cpf)
    //                    );
    //
    //                    foreach ($restrictions as $restriction) {
    //                        array_push($this->alerts, $restriction->message);
    //                    }
    //                }
    //            } else {
    //                $this->person_id = null;
    //                $this->full_name = null;
    //                $this->origin = null;
    //            }
    //        } catch (\Exception $e) {
    //            $this->focus('cpf');
    //            info('Exception no CPF');
    //        }
    //    }

    public function updated($name, $value)
    {
        $person = new Person();
        $person->fill([
            'full_name' => $this->full_name,
            'social_name' => $this->social_name,
            'document_number' => $this->document_number,
            'document_type_id' => $this->document_type_id,
        ]);
        $this->emit('personModified', $person);
    }

    public function searchDocumentNumber()
    {
        if (!is_null($this->document_number) && $this->document_number != '') {
            $document = app(Documents::class)->findByNumber(
                remove_punctuation($this->document_number)
            );

            if (!is_null($document)) {
                $this->person = $document->person;
                $this->person_id = $this->person->id;
                $this->fillModel();
                $this->documentNumber = mb_strtoupper(remove_punctuation($document->number));
                $this->document_type_id = $document->document_type_id;
                $this->setAddressReadOnly(true);
                $this->readonly = true;
            } else {
                $this->person = new Person();
                $this->readonly = false;
            }
        }

        $this->updated('document_number', $this->document_number);
    }

    public function fillModel()
    {
        $this->alerts = [];
        if (!empty($this->person_id)) {
            $this->person = Person::where('id', $this->person_id)->first();
            $this->document_number = $document_number = mb_strtoupper(
                remove_punctuation($this->person->documents[0]->number)
            );
            $this->readonly = true;
        } else {
            $document_number = is_null(old('document_number'))
                ? mask_cpf($this->person->cpf) ?? ''
                : mask_cpf(old('document_number'));

            $this->document_number = mb_strtoupper(remove_punctuation($document_number));
        }

        $this->person_id = is_null(old('person_id')) ? $this->person->id ?? '' : old('person_id');
        $this->full_name = is_null(old('full_name'))
            ? mb_strtoupper($this->person->full_name) ?? ''
            : old('full_name');

        $this->social_name = is_null(old('social_name'))
            ? mb_strtoupper($this->person->social_name) ?? ''
            : old('social_name');


        $this->loadCountryBr();
        $this->country_id = is_null(old('country_id'))
            ? $this->person->country_id ?? ''
            : old('country_id');
        $this->select2SelectOption('country_id',$this->country_id);

        if(!$this->detectIfCountryBrSelected()){
            $this->countryBrNotSelected();
        }else {
            $this->state_id = is_null(old('state_id'))
                ? $this->person->state_id ?? ''
                : old('state_id');
            $this->select2SelectOption('state_id', $this->state_id);

            if (!empty($this->state_id)) {
                $this->updatedStateId($this->state_id);
            }

            $this->city_id = is_null(old('city_id')) ? $this->person->city_id ?? '' : old('city_id');
            $this->select2SelectOption('city_id', $this->city_id);
        }

        if (!empty($this->visitor)) {
            //???
            //$this->document_number = mb_strtoupper($this->visitor->document->number);
        }

        $this->other_city = is_null(old('other_city'))
            ? mb_strtoupper($this->person->other_city) ?? ''
            : old('other_city');

        $this->origin = is_null(old('origin'))
            ? mb_strtoupper($this->person->origin) ?? ''
            : old('origin');

        if ($this->showRestrictions) {
            $restrictions = app(PersonRestrictionsRepository::class)->getRestrictions(
                remove_punctuation($this->document_number)
            );

            foreach ($restrictions as $restriction) {
                array_push($this->alerts, $restriction->message);
            }
        }

    }

    public function mount()
    {
        if ($this->mode == 'create') {
            $this->person = new Person();
        }

        if (!empty($this->visitor_id)) {
            $this->visitor = Visitor::where('id', $this->visitor_id)
                ->first()
                ->append('photo');
            if ($this->visitor->photo == "/img/no-photo.svg") {
                $this->webcam_file = "";
            } else {
                $this->webcam_file = $this->visitor->photo;
            }
            $this->webcam_data_uri = true;
        } else {
            $this->webcam_data_uri = false;
        }


        $this->fillModel();
        $this->loadDefault();
    }

    public function render()
    {
        $this->loadCountryBr();

        return view('livewire.people.partials.person')->with($this->getViewVariables());
    }

    protected function formVariables()
    {
        return [
            'countries' => app(Countries::class)->allOrderBy('name', 'asc', null),
            'states' => app(States::class)->allOrderBy('name', 'asc', null),
            'documentTypes' => app(DocumentTypes::class)->allOrderBy('name', 'asc', null),
            'country_br' => Country::where(
                'id',
                '=',
                mb_strtoupper(env('APP_COUNTRY_BR'))
            )->first(),
        ];
    }

    public function openModal()
    {
        $this->dispatchBrowserEvent('openDocumentModalFOrm');
    }

    private function loadDefault()
    {
        if (empty($this->document_type_id)) {
            $this->document_type_id = DocumentType::where('name', '=', 'CPF')->first()->id;
        }

        if (empty($this->country_id)) {
            $this->country_id = Country::where(
                'id',
                '=',
                mb_strtoupper(env('APP_COUNTRY_BR'))
            )->first()->id;
        }
    }

    public function loadCities()
    {
        if($this->state_id) {
            $this->cities = City::where('state_id', $this->state_id)->get();
        }
    }

    public function updatedCountryId($newValue)
    {
        if ($newValue != $this->countryBr->id) {
            $this->countryBrNotSelected();
        }else{
            $this->countryBrSelected();
        }
    }

    public function updatedStateId($newValue)
    {
        $this->loadCities();

        $this->cities = collect($this->cities);

        $this->select2ReloadOptions($this->cities->map(function ($city) {
            return [
                'name' => $city->name,
                'value' => $city->id,
            ];
        })->toArray(), 'city_id');

        if($this->city_id){
            $this->select2SelectOption('city_id', $this->city_id);
        }
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

    /**
     * @return void
     */
    protected function loadCountryBr(): void
    {
        $this->countryBr = Country::where('name', 'ilike', 'Brasil')->first();
    }

    /**
     * @return bool
     */
    protected function detectIfCountryBrSelected(): bool
    {
        return !!($this->country_id == $this->countryBr->id);
    }

    protected function setAddressReadOnly($value): void
    {
        $this->select2SetReadOnly('country_id', $value);
        $this->select2SetReadOnly('state_id', $value);
        $this->select2SetReadOnly('city_id', $value);
    }

    /**
     * @return void
     */
    protected function countryBrNotSelected(): void
    {
        $this->select2Destroy('city_id');
        $this->select2Destroy('state_id');
    }

    /**
     * @return void
     */
    protected function countryBrSelected(): void
    {
        $this->select2Reload('city_id');
        $this->select2Reload('state_id');
    }
}
