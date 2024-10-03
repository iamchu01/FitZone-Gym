function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('image-preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);

}
document.addEventListener('DOMContentLoaded', function() {
    const decrementButton = document.getElementById('decrement_duration');
    const incrementButton = document.getElementById('increment_duration');
    const durationInput = document.getElementById('program_duration');

    decrementButton.addEventListener('click', function() {
        let value = parseInt(durationInput.value || durationInput.placeholder, 10);
        if (value > 0) {
            value--;
            durationInput.value = value;
        }
    });

    incrementButton.addEventListener('click', function() {
        let value = parseInt(durationInput.value || durationInput.placeholder, 10);
        value++;
        durationInput.value = value;
    });
});
// weekly 
document.addEventListener('DOMContentLoaded', function () {
    const programDurationInput = document.getElementById('program_duration');
    const weekTableContainer = document.getElementById('week-table-container');
    let programDuration = 0;

    // Function to update the modal header
    function updateModalHeader(week, day) {
        const modalLabel = document.getElementById('dayModalLabel');
        modalLabel.textContent = `Week ${week} ${day}`;
    }

    function updateWeekTable() {
        weekTableContainer.innerHTML = ''; // Clear existing table
        
        if (programDuration > 0) {
            // Create table element
            const table = document.createElement('table');
            table.className = 'table table-bordered';
            
            // Create thead
            const thead = document.createElement('thead');
            const headerRow = document.createElement('tr');
            const weekHeader = document.createElement('th');
            weekHeader.textContent = 'Weeks';
            headerRow.appendChild(weekHeader);
            thead.appendChild(headerRow);
            table.appendChild(thead);

            // Create tbody
            const tbody = document.createElement('tbody');
            
            // Add week titles and day buttons to table rows
            for (let i = 1; i <= programDuration; i++) {
                const row = document.createElement('tr');
                const cell = document.createElement('td');

                // Week title
                const weekTitle = document.createElement('h5');
                weekTitle.textContent = 'Week ' + i;
                weekTitle.style.marginBottom = '10px'; // Add margin to separate title from buttons
                cell.appendChild(weekTitle);

                // Days of the week as buttons with unique IDs
                const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                daysOfWeek.forEach(day => {
                    const dayButton = document.createElement('button');
                    dayButton.className = 'btn btn-outline-primary mr-2 mb-2'; // Outline button with margin
                    dayButton.textContent = day;
                    dayButton.type = 'button'; // Prevent form submission
                    dayButton.id = `w${i}${day.toLowerCase()}`; // Unique ID e.g., "w1monday"
                    dayButton.setAttribute('data-bs-toggle', 'modal');
                    dayButton.setAttribute('data-bs-target', '#dayModal');

                    // Add event listener to update modal header
                    dayButton.addEventListener('click', function() {
                        updateModalHeader(i, day);
                    });

                    cell.appendChild(dayButton);
                });

                row.appendChild(cell);
                tbody.appendChild(row);
            }

            table.appendChild(tbody);
            weekTableContainer.appendChild(table);
        }
    }

    document.getElementById('increment_duration').addEventListener('click', function () {
        programDuration++;
        programDurationInput.value = programDuration;
        updateWeekTable();
    });

    document.getElementById('decrement_duration').addEventListener('click', function () {
        if (programDuration > 0) {
            programDuration--;
            programDurationInput.value = programDuration;
            updateWeekTable();
        }
    });
});
//anti refresh 
window.addEventListener('beforeunload', function (e) {
    const message = 'Are you sure you want to leave this page? Your changes may not be saved.';
    e.preventDefault(); 
    e.returnValue = message; 

    return message; 
});
//day exercise
document.getElementById('addExercise').addEventListener('click', function() {
    const table = document.createElement('table');
    table.className = 'table table-bordered';
    
    const thead = document.createElement('thead');
    thead.innerHTML = `
      <tr>
        <th>Exercise</th>
        <th>Set</th>
        <th>Rep</th>
        <th>Time</th>
      </tr>
    `;
    
    table.appendChild(thead);
    
    const tbody = document.createElement('tbody');
    tbody.innerHTML = `
      <tr>
        <td><input type="text" class="form-control"></td>
        <td><input type="number" class="form-control"></td>
        <td><input type="number" class="form-control"></td>
        <td><input type="text" class="form-control"></td>
      </tr>
    `;
    
    table.appendChild(tbody);
    
    document.getElementById('exerciseContainer').appendChild(table);
  });
  
  document.getElementById('removeExercise').addEventListener('click', function() {
    const exerciseContainer = document.getElementById('exerciseContainer');
    if (exerciseContainer.lastChild) {
      exerciseContainer.removeChild(exerciseContainer.lastChild);
    }
  });
