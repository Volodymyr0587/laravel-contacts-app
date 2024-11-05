@if ($upcomingBirthdayInfo)
    <div class="has-tooltip">
        <x-svg.birthday-cake />
        <div class='tooltip flex items-center gap-x-2 border px-5 py-2 shadow-2xl shadow-black bg-white rounded-2xl ml-8 -mt-20'>
            <x-svg.birthday-confetti />
            <span class="text-lg font-semibold shadow-2xl bg-gradient-to-r from-blue-600 via-green-500 to-yellow-600 inline-block text-transparent bg-clip-text">
                Birthday on {{ $upcomingBirthdayInfo['date'] }} ({{ $upcomingBirthdayInfo['days_left'] }} days left)
            </span>
            <x-svg.birthday-confetti class="scale-x-100" />
        </div>
    </div>
@endif

