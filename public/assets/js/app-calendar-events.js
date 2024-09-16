/**
 * App Calendar Events
 */

'use strict';

let date = new Date();
let nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
// prettier-ignore
let nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() + 1, 1);
// prettier-ignore
let prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() - 1, 1);

function fetchEvents() {
  return new Promise(function (resolve, reject) {
    $.ajax({
      url: '/api/bookings',
      type: 'GET',
      success: function (result) {
        if (result.data) {
          var bookings = result.data;

          var events = bookings;

          resolve(events);
        } else {
          reject('Error fetching bookings: ' + result.message);
        }
      },
      error: function (error) {
        reject('AJAX Error: ' + error);
      }
    });
  });
}
let events = []
// Usage of fetchEvents with promises
fetchEvents()
  .then(function (fetchedEvents) {
    events = fetchedEvents;

    // You can render the calendar or perform other operations here
  })
  .catch(function (error) {
    console.error(error);
  });
