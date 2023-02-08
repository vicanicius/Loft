<?php

namespace App\Repositories;

use App\Exceptions\StandardException;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private OccupationAttributesRepository $occupationAttributesRepository) {
        $this->occupationAttributesRepository = $occupationAttributesRepository;
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' =>  $request->name,
                'occupation_attributes_id' => $this->occupationAttributesRepository->getIdByName($request->occupation)
            ]);
    
            DB::commit();
            return $user->load('occupationAttributes');
        } catch (Exception $ex) {
            DB::rollBack();
            throw new StandardException("Não foi possivel criar seu personagem", Response::HTTP_BAD_REQUEST);
        }
    }
}
