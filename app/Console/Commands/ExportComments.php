<?php

namespace App\Console\Commands;

use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\Facades\Validator as Validation;
use Illuminate\Validation\Validator;
use Revolution\Google\Sheets\Facades\Sheets;

class ExportComments extends Command implements Isolatable
{
    /**
     * url google sheets.
     *
     * @var string
     */
    protected $url_google = 'https://docs.google.com/spreadsheets/d/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:comments ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to export comments between two dates to google sheet';

    /**
     * Execute the console command.
     */
    public function handle(CommentRepositoryInterface $commentRepository): int
    {
        // $start_date = $this->ask('start date (Y-m-d)?');
        // $end_date = $this->ask('end date (Y-m-d)?');
        $end_date = '2023-11-06';
        $start_date = '2023-11-05';

        // $validator = $this->validateInputs($start_date, $end_date);

        // if ($validator->fails()) {
        //     $this->info('Comments not exported. See error messages below:');

        //     foreach ($validator->errors()->all() as $error) {
        //         $this->error($error);
        //     }

        //     return 1;
        // }

        $comments = $commentRepository->getAllCommentsByDate($start_date, $end_date)->toArray();
        $spreadsheet_id = config('google.config.spreadsheet_id');
        $this->exportComments($comments, $spreadsheet_id, $start_date);
        $this->info('Comments exported to '.$this->url_google.$spreadsheet_id);

        return 0;
    }

    /**
     * Make validation of params.
     */
    private function validateInputs(mixed $start_date, mixed $end_date): Validator
    {
        return Validation::make([
            'start_date' => $start_date,
            'end_date' => $end_date,
        ], [
            'start_date' => ['required', 'string', 'date_format:Y-m-d'],
            'end_date' => ['required', 'string', 'date_format:Y-m-d'],
        ]);
    }

    /**
     * Export comments to google sheets.
     */
    private function exportComments(array $comments, string $spreadsheet_id, string $sheet_name): void
    {
        try {
            Sheets::spreadsheet($spreadsheet_id)->addSheet($sheet_name);
        } catch (\Throwable $th) {
            Sheets::spreadsheet($spreadsheet_id)->sheet($sheet_name)->range('')->clear();
        }
        Sheets::sheet($sheet_name)->append($comments);
    }
}
