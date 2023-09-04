<?php

namespace App\Data\Repositories;

use App\Models\DocumentType;
use Illuminate\Support\Facades\Cache;

class DocumentTypes extends Repository
{
    /**
     * @var string
     */
    protected $model = DocumentType::class;

    public function getByName($name)
    {
        return Cache::remember('document_type:' . $name, now()->addHours(24), function () use (
            $name
        ) {
            return DocumentType::where('name', $name)->first();
        });
    }

    public function getCPF()
    {
        return $this->getByName('CPF');
    }

    public function allActive($id = null)
    {
        $tmpId = empty($id) ? null : $id;

        return $this->model
            ::where(function ($query) use ($tmpId) {
                $query
                    ->when(isset($tmpId), function ($query) use ($tmpId) {
                        $query->orWhere('id', '=', $tmpId);
                    })
                    ->orWhere('status', true);
            })
            ->orderBy('name')
            ->get();
    }
}
