<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyAwalModel extends Model
{
    protected $table = 'survey_awal';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_meteran', 'petugas', 'foto', 'tanggal_penugasan', 'status', 'tanggal_survey'
    ];

    public function getSurveyWithPetugas($id_meteran)
    {
        return $this->select('survey_awal.*, petugas.nama as nama_petugas')
            ->join('petugas', 'petugas.users_id = survey_awal.petugas', 'left')
            ->where('survey_awal.id_meteran', $id_meteran)
            ->first();
    }

    public function getSurveyByPetugas($petugasId)
    {
        return $this->select('survey_awal.*, pengguna.nama, pengguna.alamat, pengguna.no_hp')
            ->join('pengguna', 'pengguna.id_meteran = survey_awal.id_meteran')
            ->where('survey_awal.petugas', $petugasId)
            ->findAll();
    }

}
