<?php

namespace App\Interfaces;

interface CandidateInterface
{
    public function all();


    public function create( array$request);


    public function delete(int$id);


    public function update(array$request, int$id);
}
