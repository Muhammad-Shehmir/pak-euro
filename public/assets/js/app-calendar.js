/**
 * App Calendar
 */

/**
 * ! If both start and end dates are same Full calendar will nullify the end date value.
 * ! Full calendar will end the event on a day before at 12:00:00AM thus, event won't extend to the end date.
 * ! We are getting events from a separate file named app-calendar-events.js. You can add or remove events from there.
 *
 **/

'use strict';

let direction = 'ltr';

if (isRtl) {
  direction = 'rtl';
}

document.addEventListener('DOMContentLoaded', function () {
  (function () {
    const calendarEl = document.getElementById('calendar'),
      appCalendarSidebar = document.querySelector('.app-calendar-sidebar'),
      addEventSidebar = document.getElementById('addEventSidebar'),
      appOverlay = document.querySelector('.app-overlay'),
      calendarsColor = {
        'scheduled': 'primary',
        'checked-in': 'success',
        'cancelled': 'danger',
        'checked-out': 'warning'
      },
      offcanvasTitle = document.querySelector('.offcanvas-title'),
      // btnToggleSidebar = document.querySelector('.btn-toggle-sidebar'),
      btnSubmit = document.querySelector('button[type="submit"]'),
      btnDeleteEvent = document.querySelector('.btn-delete-event'),
      btnDetail = document.querySelector('.btn-detail'),
      btnCancel = document.querySelector('.btn-cancel'),
      charges = document.querySelector('#charges'),
      booking_id = document.querySelector('#booking_id'),
      booking_start = document.querySelector('#booking_start'),
      booking_end = document.querySelector('#booking_end'),
      booking_day = document.querySelector('#booking_day'),
      day_id = document.querySelector('#day_id'),
      discount = document.querySelector('#discount'),
      // countScheduledAppointments = document.querySelector('#countScheduledAppointments'),
      // countConfirmedAppointments = document.querySelector('#countConfirmedAppointments'),
      // countCheckedInAppointments = document.querySelector('#countCheckedInAppointments'),
      // countEngagedAppointments = document.querySelector('#countEngagedAppointments'),
      // countCheckedOutAppointments = document.querySelector('#countCheckedOutAppointments'),
      // countNoShowAppointments = document.querySelector('#countNoShowAppointments'),
      no_of_nights = document.querySelector('#no_of_nights'),
      num_of_adults = document.querySelector('#num_of_adults'),
      num_of_child = document.querySelector('#num_of_child'),
      tax = document.querySelector('#tax'),
      status_select = document.querySelector('.patient-status-select'),
      customer_id = $('#customer_id'), // ! Using jquery vars due to select2 jQuery dependency
      product_id = $('#product_id'), // ! Using jquery vars due to select2 jQuery dependency
      customer_status = $('#customer_status'), // ! Using jquery vars due to select2 jQuery dependency
      amount = document.querySelector('#amount'),
      comment = document.querySelector('#comment'),
      // allDaySwitch = document.querySelector('.allDay-switch'),
      selectAll = document.querySelector('.select-all'),
      filterInput = [].slice.call(document.querySelectorAll('.input-filter')),
      inlineCalendar = document.querySelector('.inline-calendar');

    let eventToUpdate,
      currentEvents = events, // Assign app-calendar-events.js file events (assume events from API) to currentEvents (browser store/object) to manage and update calender events
      isFormValid = false,
      inlineCalInstance;

    // Init event Offcanvas
    const bsAddEventSidebar = new bootstrap.Offcanvas(addEventSidebar);

    //! TODO: Update Event label and guest code to JS once select removes jQuery dependency
    // Event Label (select2)

    // Event start (flatpicker) 
    if (booking_start) {
      var start = booking_start.flatpickr({
        enableTime: true,
        altFormat: 'Y-m-d h:i:S',
        dateFormat: 'Y-m-d h:i:S K',
        onReady: function (selectedDates, dateStr, instance) {
          if (instance.isMobile) {
            instance.mobileInput.setAttribute('step', null);
          }
        }
      });
    }

    if (booking_end) {
      var end = booking_end.flatpickr({
        enableTime: true,
        altFormat: 'Y-m-d H:i:S',  // Use 24-hour format for altFormat
        dateFormat: 'Y-m-d h:i:S K',  // Use 12-hour format for dateFormat
        onReady: function (selectedDates, dateStr, instance) {
          if (instance.isMobile) {
            instance.mobileInput.setAttribute('step', null);
          }
        }
      });
    }



    // Inline sidebar calendar (flatpicker)
    if (inlineCalendar) {
      inlineCalInstance = inlineCalendar.flatpickr({
        monthSelectorType: 'static',
        inline: true
      });
    }

    // Event click function
    function eventClick(info) {
      var eventId = info.event._def.publicId;
      // console.log(eventId)

      $.ajax({
        url: `/api/booking/${eventId}`, // Replace with your API endpoint
        type: 'GET',
        success: function (response) {
          if (response.data) {
            const eventToUpdate = response.data;

            // Populate the event form fields with the fetched data
            booking_id.value = eventToUpdate.id;
            booking_start.value = moment(eventToUpdate.booking_start).format('YYYY-MM-DD hh:mm:ss A');
            booking_end.value = moment(eventToUpdate.booking_end).format('YYYY-MM-DD hh:mm:ss A');
            booking_day.value = eventToUpdate?.day?.name;
            day_id.value = eventToUpdate?.day_id;
            customer_id.val(eventToUpdate?.customer_id).trigger('change');
            product_id.val(eventToUpdate?.product_id).trigger('change');
            customer_status.val(eventToUpdate?.customer_status ? eventToUpdate?.customer_status.customer_status : 'scheduled').trigger('change');
            charges.value = eventToUpdate?.charges;
            no_of_nights.value = eventToUpdate?.no_of_nights;
            num_of_adults.value = eventToUpdate?.num_of_adults;
            num_of_child.value = eventToUpdate?.num_of_child;
            discount.value = eventToUpdate?.discount;
            tax.value = eventToUpdate?.tax;
            amount.value = eventToUpdate?.total_amount;
            comment.value = eventToUpdate?.comment;

            // Show the edit form in your UI (e.g., open a modal)
            bsAddEventSidebar.show();
            if (offcanvasTitle) {
              offcanvasTitle.innerHTML = 'Update Booking';
            }
            btnSubmit.innerHTML = 'Update';
            btnSubmit.classList.add('btn-update-event');
            btnSubmit.classList.remove('btn-add-event');
            btnDeleteEvent.classList.remove('d-none');
            btnDetail.classList.remove('d-none');
            status_select.classList.remove('d-none');
          } else {
            console.error('Error fetching event details:', response.message);
          }
        },
        error: function (error) {
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Something Went Wrong!',
            showConfirmButton: false,
            timer: 2500
          });
        }
      });

      btnDeleteEvent.addEventListener('click', e => {
        // console.log(eventId)
        removeEvent(parseInt(eventId));
        // eventToUpdate.remove();
        bsAddEventSidebar.hide();
      });

      btnDetail.addEventListener('click', e => {
        // console.log(appointment_id.value)
        window.location.href = '/customer-profile/' + customer_id.val();
      });

      //   // console.log(eventId)
      //   invoiceEvent(parseInt(eventId));
      //   // eventToUpdate.remove();
      //   bsAddEventSidebar.hide();
      // });

      // btnDetail.addEventListener('click', e => {
      //   // console.log(booking_id.value)
      //   window.location.href = '/appointment-detail/' + booking_id.value;
      // });
    }

    // Modify sidebar toggler
    function modifyToggler() {
      const fcSidebarToggleButton = document.querySelector('.fc-sidebarToggle-button');
      fcSidebarToggleButton.classList.remove('fc-button-primary');
      fcSidebarToggleButton.classList.add('d-lg-none', 'd-inline-block', 'ps-0');
      while (fcSidebarToggleButton.firstChild) {
        fcSidebarToggleButton.firstChild.remove();
      }
      fcSidebarToggleButton.setAttribute('data-bs-toggle', 'sidebar');
      fcSidebarToggleButton.setAttribute('data-overlay', '');
      fcSidebarToggleButton.setAttribute('data-target', '#app-calendar-sidebar');
      fcSidebarToggleButton.insertAdjacentHTML('beforeend', '<i class="mdi mdi-menu mdi-24px text-body"></i>');
    }

    // Filter events by calender
    function selectedCalendars() {
      let selected = [],
        filterInputChecked = [].slice.call(document.querySelectorAll('.input-filter:checked'));

      filterInputChecked.forEach(item => {
        selected.push(item.getAttribute('data-value'));
      });

      // console.log(selected)
      return selected;
    }

    // --------------------------------------------------------------------------------------------------
    // AXIOS: fetchEvents
    // * This will be called by fullCalendar to fetch events. Also this can be used to refetch events.
    // --------------------------------------------------------------------------------------------------
    function fetchEvents(info, successCallback) {
      $.ajax({
        url: '/api/bookings',
        type: 'GET',
        success: function (result) {

          if (result.data.bookings) {
            var bookings = result.data.bookings;

            // Transform the appointment data into FullCalendar-compatible events
            var events = bookings.map(function (booking) {
              return {
                id: booking.id,
                title: booking?.customer?.name,
                start: booking.booking_start,
                end: booking.booking_end,
                customer_id: booking.customer_id,
                product_id: booking.product_id,
                customer_status: booking.customer_status ? booking.customer_status.customer_status : 'scheduled',
                charges: booking.charges,
                discount: booking.discount,
                no_of_nights: booking.no_of_nights,
                num_of_adults: booking.num_of_adults,
                num_of_child: booking.num_of_child,
                tax: booking.tax,
                amount: booking.total_amount,
                comment: booking.comment,
                day_id: booking.day_id,
                extendedProps: {
                  calendar: booking?.product?.name,
                  calendar: booking?.product?.name,
                  customer_status: booking.customer_status ? booking?.customer_status?.customer_status : 'scheduled',
                  productName: booking?.product?.name,
                  total_amount: booking?.total_amount,
                }
              };
            });

            var calendars = selectedCalendars();
            let selectedEvents = events.filter(function (event) {
              // Check if event.extendedProps.calendar is not null before converting to string
              return event.extendedProps.calendar !== null || event.extendedProps.calendar !== undefined && calendars.includes(event.extendedProps.calendar.toString());
            });

            // console.log('selectedEvents', selectedEvents);

            successCallback(selectedEvents);
          } else {
            console.error('Error fetching bookings:', result.message);
          }
        },
        error: function (error) {
          console.error('AJAX Error:', error);
        }
      });
    }


    // Init FullCalendar
    // ------------------------------------------------
    let calendar = new Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: fetchEvents,
      plugins: [dayGridPlugin, interactionPlugin, listPlugin, timegridPlugin],
      editable: true,
      // dragScroll: true,
      // dayMaxEvents: 2,
      // eventResizableFromStart: true,
      customButtons: {
        sidebarToggle: {
          text: 'Sidebar'
        }
      },
      headerToolbar: {
        start: 'sidebarToggle, prev,next, title',
        end: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      scrollTime: moment().format('HH:mm'),
      navLinks: true,
      eventClassNames: function ({ event: calendarEvent }) {
        console.log(calendarEvent._def.extendedProps.customer_status);
        const colorName = calendarsColor[calendarEvent._def.extendedProps.customer_status];
        console.log(colorName);
        return ['fc-event-' + colorName];
      },
      eventMinHeight: 50,
      eventMaxStack: 1,
      slotEventOverlap: false,
      firstDay: moment().day(),
      dateClick: function (info) {
        const dayNameToIdMapping = {
          'Monday': 1,
          'Tuesday': 2,
          'Wednesday': 3,
          'Thursday': 4,
          'Friday': 5,
          'Saturday': 6,
          'Sunday': 7,
        };
        let startDate = moment(info.date);
        let endDate = startDate.clone().add(1, 'day');
        let formattedStartDate = startDate.format('YYYY-MM-DD hh:mm:ss A');
        let formattedEndDate = endDate.format('YYYY-MM-DD hh:mm:ss A');
        let day = moment(info.date, 'YYYY-MM-DD HH:mm:ss').format('dddd');
        let dayId = dayNameToIdMapping[day];
        resetValues();
        bsAddEventSidebar.show();
        console.log(day);

        // For new event set offcanvas title text: Add Event
        if (offcanvasTitle) {
          offcanvasTitle.innerHTML = 'Add Booking';
        }
        btnSubmit.innerHTML = 'Add';
        btnSubmit.classList.remove('btn-update-event');
        btnSubmit.classList.add('btn-add-event');
        btnDeleteEvent.classList.add('d-none');
        btnDetail.classList.add('d-none');
        status_select.classList.add('d-none');
        booking_start.value = formattedStartDate;
        booking_end.value = formattedEndDate;
        booking_day.value = day;
        day_id.value = dayId;
      },
      eventClick: function (info) {
        eventClick(info);
      },
      // eventMouseEnter: function (info) {
      //   // Display procedure name, doctor name, and charges when hovering over the event
      //   const event = info.event;
      //   const colorName = calendarsColor[event.extendedProps.customer_status];
      //   const tooltipContent = `
      //     Customer: ${event.title}<br>
      //     Room: ${event.extendedProps.productName}<br>
      //     Amount: $${event.extendedProps.total_amount} `;
      //   showTooltip(info.jsEvent, tooltipContent, colorName);
      // },
      // eventMouseLeave: function (info) {
      //   // Remove the tooltip when the mouse leaves the event
      //   hideTooltip();
      // },
      datesSet: function () {
        modifyToggler();
      },
      viewDidMount: function () {
        modifyToggler();
      }
    });
    let tooltip = null; // Define a variable to hold the tooltip element

    // Function to show a tooltip
    // function showTooltip(jsEvent, content, colorName) {
    //   hideTooltip(); // Remove any existing tooltips

    //   tooltip = document.createElement('div');
    //   tooltip.innerHTML = content;
    //   tooltip.className = 'custom-tooltip' + ' fc-event-' + colorName;

    //   // Position the tooltip near the mouse cursor
    //   tooltip.style.position = 'fixed';
    //   tooltip.style.left = jsEvent.clientX + 'px';
    //   tooltip.style.top = jsEvent.clientY + 'px';

    //   document.body.appendChild(tooltip);
    // }

    // // Function to hide the tooltip
    // function hideTooltip() {
    //   if (tooltip) {
    //     tooltip.remove();
    //     tooltip = null;
    //   }
    // }
    // Render calendar
    calendar.render();

    // Modify sidebar toggler
    modifyToggler();

    const eventForm = document.getElementById('eventForm');

    // Add Event
    // ------------------------------------------------
    async function addEvent(eventData) {
      const isEventExists = events.length > 0 && events.some(event => {
        return (
          event.day_id === parseInt(eventData.day_id) &&
          event.appointment_at === eventData.booking_start &&
          event.product_id === parseInt(eventData.product_id)
        );
      });
      if (isEventExists) {
        // Show an error message if the event already exists
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'A Booking of the Room Already Exists on this Time!',
          showConfirmButton: false,
          timer: 2500
        });
      } else {
        try {
          const response = await $.ajax({
            type: 'POST',
            data: eventData,
            url: '/api/booking/save',
            dataType: 'json',
          });

          if (response.status === 200) {
            // Event added to the database successfully
            bsAddEventSidebar.hide();
            // Show a success message
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: 'Room Booked Successfully!',
              showConfirmButton: false,
              timer: 2500
            });

            // Wait for 1 second (1000 milliseconds) before refreshing the events
            await new Promise(resolve => setTimeout(resolve, 1000));

            // Refresh calendar events
            calendar.refetchEvents();
          } else {
            // Handle errors or display an error message
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: 'Something Went Wrong!',
              showConfirmButton: false,
              timer: 2500
            });
          }
        } catch (error) {
          // Handle AJAX error
          console.error('AJAX Error:', error);
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Something Went Wrong!',
            showConfirmButton: false,
            timer: 2500
          });
        }
      }
    }
    $(document).ready(function () {
      $('#customer_status').on('change', function () {
        // Call the saveCustomerStatus function when #customer_status is changed
        saveCustomerStatus();
      });
    });

    function saveCustomerStatus() {
      // Get the selected value from the dropdown
      const selectedStatus = document.getElementById('customer_status').value;

      // You may need to get the booking_id from somewhere (e.g., an attribute on the HTML element, a hidden input, etc.)
      // Replace 'YOUR_APPOINTMENT_ID' with the logic to get the booking_id
      const bookingId = booking_id.value;
      // console.log(bookingId)

      // Use Blade to generate the URL
      const apiUrl = 'api/customer-status/save' + '/' + bookingId;

      // Make an AJAX call to save the status and booking_id
      $.ajax({
        type: 'POST',
        data: {
          status: selectedStatus,
        },
        url: apiUrl,
        dataType: 'json',
        success: function (result) {
          calendar.refetchEvents();
          // Swal.fire({
          //   toast: true,
          //   position: 'top-end',
          //   icon: 'success',
          //   title: 'Patient Updated Successfully!',
          //   showConfirmButton: false,
          //   timer: 2500
          // });
        },
        error: function (error) {
          console.error('Error saving customer status:', error);
        },
      });
    }


    // Update Event
    // ------------------------------------------------
    function updateEvent(eventData) {
      // console.log(eventData)
      $.ajax({
        url: '/api/booking/update/' + eventData.id,
        type: 'POST',
        data: JSON.stringify(eventData),
        contentType: "application/json",
        dataType: "json",
        success: function (response) {
          if (response.status === 200) {
            // Appointment updated successfully
            // Handle success, e.g., close the modal or show a success message
            bsAddEventSidebar.hide();
            calendar.refetchEvents(); // Refresh the calendar
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: 'Booking Updated Successfully!',
              showConfirmButton: false,
              timer: 2500
            });
          } else {
            // Handle errors or display an error message
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: 'Something Went Wrong!',
              showConfirmButton: false,
              timer: 2500
            });
          }
        },
        error: function (error) {
          // Handle AJAX error
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Something Went Wrong!',
            showConfirmButton: false,
            timer: 2500
          });
        }
      });
    }

    // Remove Event
    // ------------------------------------------------

    // function invoiceEvent(eventId) {

    //   $.ajax({
    //     type: "POST",
    //     url: "/api/booking/delete/" + eventId, // Replace with the actual delete API URL
    //     dataType: 'json',
    //     success: function (response) {
    //       if (response.status === 200) {
    //         // Appointment deleted successfully
    //         calendar.refetchEvents();
    //         // Show a success message
    //         Swal.fire({
    //           toast: true,
    //           position: 'top-end',
    //           icon: 'success', // Use 'success' icon for success message
    //           title: 'Booking Deleted Successfully!',
    //           showConfirmButton: false,
    //           timer: 2500
    //         });
    //       } else {
    //         // Handle errors or display an error message
    //         console.error('Error deleting appointment:', response.error);
    //         // Show an error message
    //         Swal.fire({
    //           toast: true,
    //           position: 'top-end',
    //           icon: 'error',
    //           title: 'Something Went Wrong!',
    //           showConfirmButton: false,
    //           timer: 2500
    //         });
    //       }
    //     }
    //   });

      function removeEvent(eventId) {
        // Show a confirmation dialog before deleting the appointment
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3b91e1',
          cancelButtonColor: '#ff4d49',
          confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
          if (result.isConfirmed) {
            // User confirmed, proceed with the delete operation
            $.ajax({
              type: "POST",
              url: "/api/booking/delete/" + eventId, // Replace with the actual delete API URL
              dataType: 'json',
              success: function (response) {
                if (response.status === 200) {
                  // Appointment deleted successfully
                  calendar.refetchEvents();
                  // Show a success message
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success', // Use 'success' icon for success message
                    title: 'Booking Deleted Successfully!',
                    showConfirmButton: false,
                    timer: 2500
                  });
                } else {
                  // Handle errors or display an error message
                  console.error('Error deleting appointment:', response.error);
                  // Show an error message
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Something Went Wrong!',
                    showConfirmButton: false,
                    timer: 2500
                  });
                }
              },
              error: function (error) {
                Swal.fire({
                  toast: true,
                  position: 'top-end',
                  icon: 'error',
                  title: 'Something Went Wrong!',
                  showConfirmButton: false,
                  timer: 2500
                });
              }
            });
          }
        });
      }


      // (Update Event In Calendar (UI Only)
      // ------------------------------------------------
      const updateEventInCalendar = (updatedEventData, propsToUpdate, extendedPropsToUpdate) => {
        const existingEvent = calendar.getEventById(updatedEventData.id);

        // --- Set event properties except date related ----- //
        // ? Docs: https://fullcalendar.io/docs/Event-setProp
        // dateRelatedProps => ['start', 'end', 'allDay']
        // eslint-disable-next-line no-plusplus
        for (var index = 0; index < propsToUpdate.length; index++) {
          var propName = propsToUpdate[index];
          existingEvent.setProp(propName, updatedEventData[propName]);
        }

        // --- Set date related props ----- //
        // ? Docs: https://fullcalendar.io/docs/Event-setDates
        existingEvent.setDates(updatedEventData.start, updatedEventData.end, {
          allDay: updatedEventData.allDay
        });

        // --- Set event's extendedProps ----- //
        // ? Docs: https://fullcalendar.io/docs/Event-setExtendedProp
        // eslint-disable-next-line no-plusplus
        for (var index = 0; index < extendedPropsToUpdate.length; index++) {
          var propName = extendedPropsToUpdate[index];
          existingEvent.setExtendedProp(propName, updatedEventData.extendedProps[propName]);
        }
      };

      // Remove Event In Calendar (UI Only)
      // ------------------------------------------------
      function removeEventInCalendar(eventId) {
        calendar.getEventById(eventId).remove();
      }

      // Add new event
      // ------------------------------------------------
      btnSubmit.addEventListener('click', e => {
        if (btnSubmit.classList.contains('btn-add-event')) {
          const requiredFields = ['booking_start', 'product_id', 'customer_id', 'charges', 'amount']; // Add other required field IDs here

          // Check if the appointment date is in the past
          const appointmentDate = new Date(document.getElementById('booking_start').value);
          const currentDate = new Date();

          // Check if all required fields are filled
          const isAllFieldsFilled = requiredFields.every(fieldId => {
            const field = document.getElementById(fieldId);
            return field.value.trim() !== ''; // Check if the field is not empty
          });

          // if (appointmentDate < currentDate) {
          //   console.log('here')
          //   // Show a SweetAlert2 error message for past date
          //   Swal.fire({
          //     toast: true,
          //     position: 'top-end',
          //     icon: 'error',
          //     title: 'Appointment Cannot be Scheduled in Past!',
          //     showConfirmButton: false,
          //     timer: 2500
          //   })
          // } else 
          if (!isAllFieldsFilled) {
            console.log('swal')
            // Show a SweetAlert2 error message for empty fields
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: 'Please Fill All Required Fields!',
              showConfirmButton: false,
              timer: 2500
            })
          } else {
            // if (isFormValid) {
            let newEvent = {
              booking_start: booking_start.value,
              booking_end: booking_end.value,
              day: booking_day.value,
              day_id: day_id.value,
              customer_id: customer_id.val(),
              product_id: product_id.val(),
              no_of_nights: no_of_nights.value,
              num_of_adults: num_of_adults.value,
              num_of_child: num_of_child.value,
              charges: charges.value,
              discount: discount.value,
              tax: tax.value,
              amount: amount.value,
              comment: comment.value,
              // file: file,

            };

            addEvent(newEvent);
            // bsAddEventSidebar.hide();
          }
          // }
        } else {
          // Update event
          // ------------------------------------------------
          // if (isFormValid) {
          let eventData = {
            id: parseInt(booking_id.value),
            booking_start: booking_start.value,
            booking_end: booking_end.value,
            day: booking_day.value,
            day_id: day_id.value,
            customer_id: customer_id.val(),
            product_id: product_id.val(),
            no_of_nights: no_of_nights.value,
            num_of_adults: num_of_adults.value,
            num_of_child: num_of_child.value,
            charges: charges.value,
            discount: discount.value,
            tax: tax.value,
            amount: amount.value,
            comment: comment.value,
            // file: file.value,
            //   },
            //   display: 'block',
            //   allDay: allDaySwitch.checked ? true : false
          };

          updateEvent(eventData);
          // bsAddEventSidebar.hide();
          // }
        }
      });

      // Reset event form inputs values
      // ------------------------------------------------
      function resetValues() {
        // tax.value = '';
        // booking_start.value = '';
        // booking_end.value = '';
        // booking_day.value = '';
        // day_id.value = '';
        // charges.value = '';
        // discount.value = '';
        // amount.value = '';
        // no_of_nights.value = '';
        // num_of_adults.value = '';
        // num_of_child.value = '';
        // day_id.value = '';
        // // allDaySwitch.checked = false;
        // customer_id.val('').trigger('change');
        // product_id.val('').trigger('change');
        // comment.value = '';
      }

      // When modal hides reset input values
      addEventSidebar.addEventListener('hidden.bs.offcanvas', function () {
        resetValues();
      });

      // Hide left sidebar if the right sidebar is open
      // btnToggleSidebar.addEventListener('click', e => {
      //   if (offcanvasTitle) {
      //     offcanvasTitle.innerHTML = 'Add Appointment';
      //   }
      //   btnSubmit.innerHTML = 'Add';
      //   btnSubmit.classList.remove('btn-update-event');
      //   btnSubmit.classList.add('btn-add-event');
      //   btnDeleteEvent.classList.add('d-none');
      //   appCalendarSidebar.classList.remove('show');
      //   appOverlay.classList.remove('show');
      // });

      // Calender filter functionality
      // ------------------------------------------------
      if (selectAll) {
        selectAll.addEventListener('click', e => {
          if (e.currentTarget.checked) {
            document.querySelectorAll('.input-filter').forEach(c => (c.checked = 1));
          } else {
            document.querySelectorAll('.input-filter').forEach(c => (c.checked = 0));
          }
          calendar.refetchEvents();
        });
      }

      if (filterInput) {
        filterInput.forEach(item => {
          item.addEventListener('click', () => {
            document.querySelectorAll('.input-filter:checked').length < document.querySelectorAll('.input-filter').length
              ? (selectAll.checked = false)
              : (selectAll.checked = true);
            calendar.refetchEvents();
          });
        });
      }

      document.addEventListener("DOMContentLoaded", function () {
        // Initialize inlineCalInstance here or in your existing initialization code

        // Check if inlineCalInstance is defined before accessing its properties
        if (typeof inlineCalInstance !== "undefined") {
          inlineCalInstance.config.onChange.push(function (date) {
            calendar.changeView(
              calendar.view.type,
              moment(date[0]).format("YYYY-MM-DD")
            );
            modifyToggler();
            appCalendarSidebar.classList.remove("show");
            appOverlay.classList.remove("show");
          });
        }
      });

    })();
});
