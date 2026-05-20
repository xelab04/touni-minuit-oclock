<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Touni-Minuit-O'clock</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" type="image/png" href="assets/logov2.png">
    <link href="assets/output.css" rel="stylesheet">

</head>
<body class="h-screen bg-black text-white font-sans m-0">
    <div class="flex justify-center">
        <div class="relative mt-4">
            <img src="assets/logov2.png" alt="Logo" class="block max-w-full h-auto opacity-30">
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-3xl">
                <span><?= htmlspecialchars($message) ?></span>
                <?php if ($showCountdown): ?>
                    <div
                        x-data="countdown"
                        x-init="start()"
                        class="mt-4 text-2xl"
                    >
                        <span x-text="days"></span>
                        <span x-text="hours"></span>
                        <span x-text="minutes"></span>
                        <span x-text="seconds"></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="flex justify-center">
        <a href="http://www.freepik.com" class="text-xs hover:text-blue-500">Designed by upklyak / Freepik</a>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('countdown', () => ({
                target: <?= $beerTimestamp ?>,
                days: 0,
                hours: 0,
                minutes: 0,
                seconds: 0,
                pluralize(value, unit) {
                    return `${value} ${unit}${value <= 1 ? '' : 's'}`;
                },
                update() {
                    let now = Math.floor(Date.now() / 1000);
                    let diff = this.target - now;
                    if (diff < 0) diff = 0;
                    const days = Math.floor(diff / 86400);
                    const hours = Math.floor((diff % 86400) / 3600);
                    const minutes = Math.floor((diff % 3600) / 60);
                    const seconds = diff % 60;
                    this.days = this.pluralize(days, 'day');
                    this.hours = this.pluralize(hours, 'hour');
                    this.minutes = this.pluralize(minutes, 'minute');
                    this.seconds = this.pluralize(seconds, 'second');
                },
                start() {
                    this.update();
                    setInterval(() => this.update(), 1000);
                }
            }));
        });
    </script>

</body>
</html>
