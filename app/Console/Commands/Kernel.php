protected function schedule(Schedule $schedule)
{
    $schedule->command('files:delete-expired')->hourly();
}