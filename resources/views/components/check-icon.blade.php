@props(['name'])

<span {{ $attributes }} aria-hidden="true">
    <x-filament::icon :icon="match ($name) {
        'Queue', 'Horizon' => 'heroicon-o-queue-list',
        'Database', 'DatabaseSize', 'DatabaseTableSize', 'DatabaseConnectionCount' => 'heroicon-o-circle-stack',
        'Disk', 'UsedDiskSpace' => 'heroicon-o-server-stack',
        'Cache', 'Redis', 'RedisMemoryUsage' => 'heroicon-o-bolt',
        'Backups' => 'heroicon-o-archive-box',
        'Schedule' => 'heroicon-o-clock',
        'MailTransport' => 'heroicon-o-envelope',
        'Ping' => 'heroicon-o-signal',
        default => 'heroicon-o-clipboard-document-check',
    }" />
</span>
