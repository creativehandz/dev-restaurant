import Common from "../common/Common.js";
import gsap from "../../node_modules/gsap/all.js";

export default class Reservation {
  constructor() {
    this.common = new Common();
    this.setAnimations();
    this.setFormStages();
    // this.setCurrentDate();
    // this.setCurrentTime();
    this.populateDatePicker();
    this.populateTimePicker();
    this.addEventListeners();
  }

  setAnimations() {
    let tl = gsap.timeline().pause();
    this.tl = tl;

    tl.fromTo(
      ".a-1",
      {
        opacity: 0,
        y: 144,
      },
      {
        opacity: 1,
        y: 0,
        stagger: 0.2,
        duration: 0.8,
        delay: 0.2,
      },
    );
  }

  setFormStages() {
    this.stageTl1 = gsap.timeline().pause();

    this.stageTl1.to("#stage-1", {
      opacity: 0,
      pointerEvents: "none",
    });

    this.stageTl1.to(
      "#progress-line",
      {
        width: "50%",
      },
      "<",
    );

    this.stageTl1.to("#p-1", {
      backgroundColor: "#f6c859",
    });

    this.stageTl1.to("#stage-2", {
      opacity: 1,
      pointerEvents: "auto",
    });

    this.stageTl2 = gsap.timeline().pause();

    this.stageTl2.to("#stage-2", {
      opacity: 0,
      pointerEvents: "none",
    });

    this.stageTl2.to(
      "#progress-line",
      {
        width: "100%",
      },
      "<",
    );

    this.stageTl2.to("#p-2", {
      backgroundColor: "#f6c859",
    });

    this.stageTl2.to("#stage-3", {
      opacity: 1,
      pointerEvents: "auto",
    });
  }


  // setCurrentDate() {
  //   const dateInput = document.querySelector('.dateInput');
  //   if (dateInput) {
  //     const now = new Date();
  //     const year = now.getFullYear();
  //     const month = String(now.getMonth() + 1).padStart(2, '0');
  //     const day = String(now.getDate()).padStart(2, '0');
  //     const today = `${year}-${month}-${day}`;

  //     dateInput.value = today;
  //     dateInput.min = today; // Set the min attribute to today's date
  //   }
  // }

  // setCurrentTime() {
  //   const timeInput = document.querySelector('.timeInput');
  //   if (timeInput) {
  //     const now = new Date();
  //     const hours = String(now.getHours()).padStart(2, '0');
  //     const minutes = String(now.getMinutes()).padStart(2, '0');
  //     timeInput.value = `${hours}:${minutes}`;
  //   }
  // }


  populateDatePicker() {
    const datePicker = document.getElementById('datepicker');
    const now = new Date();
    const oneDay = 24 * 60 * 60 * 1000; // milliseconds in a day
    const daysToShow = 7; // Number of days to show in the dropdown

    // Create "Today" option
    let option = document.createElement('option');
    option.value = now.toISOString().split('T')[0];
    option.textContent = "Today";
    option.classList.add('text-black'); // Set the option text color to black
    datePicker.appendChild(option);

    // Create "Tomorrow" option
    let tomorrow = new Date(now.getTime() + oneDay);
    option = document.createElement('option');
    option.value = tomorrow.toISOString().split('T')[0];
    option.textContent = "Tomorrow";
    option.classList.add('text-black');
    datePicker.appendChild(option);

    // Create options for the next 5 days

    for (let i = 2; i <= daysToShow; i++) {
      const date = new Date(now.getTime() + (i * oneDay));
      const day = date.getDate();
      const month = date.toLocaleString('default', { month: 'long' });
      const weekday = date.toLocaleString('default', { weekday: 'long' });

      const option = document.createElement('option');
      option.value = date.toISOString().split('T')[0];
      option.textContent = `${weekday}, ${month} ${day}`;
      option.classList.add('text-black'); // Set the option text color to black

      datePicker.appendChild(option);
    }
  }




  populateTimePicker() {
    const timePicker = document.getElementById('timepicker');
    const now = new Date();
    const roundedUpTime = this.roundUpTime(now, 15);
    const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);
    const times = this.generateTimeSlots(roundedUpTime, tomorrow, 15); // From rounded-up time to 24 hours later, every 15 minutes
    times.forEach(time => {
      const option = document.createElement('option');
      option.value = time;
      option.textContent = time;
      option.classList.add('text-black'); // Set the option text color to black
      timePicker.appendChild(option);
    });
  }

  roundUpTime(date, interval) {
    const ms = 1000 * 60 * interval; // convert interval to milliseconds
    return new Date(Math.ceil(date.getTime() / ms) * ms);
  }

  generateTimeSlots(startTime, endTime, interval) {
    const times = [];
    let currentTime = new Date(startTime);
    while (currentTime <= endTime) {
      const time = this.formatTime(currentTime);
      times.push(time);
      currentTime = new Date(currentTime.getTime() + interval * 60 * 1000);
    }
    return times;
  }

  formatTime(date) {
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const period = hours < 12 ? 'AM' : 'PM';
    const formattedHours = hours % 12 === 0 ? 12 : hours % 12;
    const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;
    return `${formattedHours}:${formattedMinutes} ${period}`;
    }




  addEventListeners() {
    document.addEventListener("DOMContentLoaded", () => {
      this.tl.play();
      // setInterval(() => this.setCurrentTime(), 60000); // Update the time every minute
      // setInterval(() => this.setCurrentDate(), 360000); //Update the date every hour
    });

    document.querySelector("#stage-1-button").addEventListener("click", (e) => {
      e.preventDefault();
      this.stageTl1.play();
    });

    document.querySelector("#stage-2-button").addEventListener("click", (e) => {
      e.preventDefault();
      this.stageTl2.play();
    });

    document
      .querySelector("#previous-button")
      .addEventListener("click", (e) => {
        e.preventDefault();
        this.stageTl1.reverse();
      });
  }
}
