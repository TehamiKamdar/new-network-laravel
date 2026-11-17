<?php
namespace App\Enums;

enum ExportType: string
{
    case CSV = 'csv';
    case XLSX = 'xlsx';
}
