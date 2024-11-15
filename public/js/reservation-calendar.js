function populateTimePicker() {
    // Use querySelectorAll to target all elements with the id 'defaultInputdate'
    const dateInputs = document.querySelectorAll("#defaultInputdate");
    
    dateInputs.forEach((input) => {
      input.addEventListener("change", () => {
        const selectedDate = input.value;
        const options = { weekday: "long", timeZone: "UTC" };
        const day = new Date(selectedDate).toLocaleDateString(navigator.language, options);
        getTimeSchedule(day);
      });
    });
}


// Fetch and set time schedule based on the selected day
function getTimeSchedule(day) {
    console.log("Selected day:", day);
    fetch("https://tfcmockup.com/admin/api/settings")
        .then((response) => response.json())
        .then((data) => {
            const time_schedule = data.data.find((item) => item.key === "time_schedule")?.value;
            const time_schedule_obj = JSON.parse(time_schedule);
            const timeSlots = time_schedule_obj[day.toLowerCase()];

            if (timeSlots) {
            const startTime = timeSlots.start_time.split(":");
            const endTime = timeSlots.end_time.split(":");

            const now = new Date();
            const today = new Date(now.getTime());
            const startDayTime = new Date(today.getFullYear(), today.getMonth(), today.getDate(), startTime[0], startTime[1]);
            const endDayTime = new Date(today.getFullYear(), today.getMonth(), today.getDate(), endTime[0], endTime[1]);

            if (isNaN(startDayTime) || isNaN(endDayTime)) {
                console.error("Invalid time");
                return;
            }

            const times = generateTimeSlots(startDayTime, endDayTime, 30); // Generate 30-minute interval time slots

            // Apply the time slots to both time inputs with the same ID
            const timeInputs = document.querySelectorAll("#defaultInputime");
            timeInputs.forEach((input) => {
                input.innerHTML = ""; // Clear previous options
                times.forEach((time) => {
                const option = document.createElement("option");
                option.value = time;
                option.textContent = time;
                option.classList.add("text-black");
                input.appendChild(option);
                });
            });
            }
        })
        .catch((error) => {
            console.error("Error fetching time schedule:", error);
        });
}

function generateTimeSlots(start, end, interval) {
    const timeSlots = [];
    const current = new Date(start);

    while (current <= end) {
      const hours = current.getHours().toString().padStart(2, "0");
      const minutes = current.getMinutes().toString().padStart(2, "0");
      timeSlots.push(`${hours}:${minutes}`);
      current.setMinutes(current.getMinutes() + interval);
    }

    return timeSlots;
}


// Initialize functions after DOM content is loaded
document.addEventListener("DOMContentLoaded", () => {
    populateTimePicker();
});