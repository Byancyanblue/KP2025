<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Bulanan Acara</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin: 20px;
        }
        .day {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            cursor: pointer;
        }
        .day:hover {
            background-color: #f0f0f0;
        }
        #eventDetails {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Kalender Bulanan Acara</h2>
<div class="calendar" id="calendar"></div>
<div id="eventDetails"></div>

<script>
    const events = {
        '2023-10-02': ['Rapat Tim', 'Diskusi Proyek'],
        '2023-10-03': ['Presentasi Proyek'],
        '2023-10-04': ['Workshop', 'Sesi Tanya Jawab'],
        '2023-10-05': ['Diskusi'],
        '2023-10-06': ['Ujian Tengah Semester', 'Persiapan Ujian'],
        '2023-10-15': ['Acara Keluarga'],
        '2023-10-20': ['Pameran'],
        '2023-10-25': ['Rapat Evaluasi']
    };

    const calendarElement = document.getElementById('calendar');

    function generateCalendar(year, month) {
        calendarElement.innerHTML = '';
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const totalDays = lastDay.getDate();

        // Menambahkan nama hari
        const daysOfWeek = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        daysOfWeek.forEach(day => {
            const dayElement = document.createElement('div');
            dayElement.textContent = day;
            dayElement.className = 'day';
            calendarElement.appendChild(dayElement);
        });

        // Menambahkan tanggal
        for (let i = 1; i <= totalDays; i++) {
            const date = new Date(year, month, i);
            const dayElement = document.createElement('div');
            dayElement.textContent = i;
            dayElement.className = 'day';
            dayElement.onclick = () => showEvents(date.toISOString().split('T')[0]);
            calendarElement.appendChild(dayElement);
        }
    }

    function showEvents(date) {
        const eventDiv = document.getElementById('eventDetails');
        const eventList = events[date] || [];
        
        if (eventList.length > 0) {
            eventDiv.innerHTML = `<h3>Acara pada ${date}:</h3><ul>${eventList.map(event => `<li>${event}</li>`).join('')}</ul>`;
        } else {
            eventDiv.innerHTML = `<h3>Tidak ada acara pada ${date}.</h3>`;
        }
    }

    // Generate calendar for October 2023
    generateCalendar(2023, 9); // 9 is October (0-based index)
</script>

</body>
</html>