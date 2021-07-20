<?php

class Calendar_model extends CI_Model
{
    public function indocal()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date("Y-m-d H:i:s");
        return $tgl;
    }

    public function indodate()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date("Y-m-d");
        return $tgl;
    }

    public function indodate2()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date("Y-m");
        return $tgl;
    }

    public function indoyear()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date("Y");
        return $tgl;
    }

    public function indomonth()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date("m");
        return $tgl;
    }

}