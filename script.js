$(document).ready(function() {
    // Initialize counters for lock, unlock, and alarm trigger events
    let lockCount = 0;
    let unlockCount = 0;
    let alarmCount = 0;
    let carStatus = 'locked';  // Track the current status of the car

    // Update car statistics (mock data for demonstration)
    function updateCarStatistics() {
        $('#batteryLevel').text('Battery Level: 87%');
        $('#location').text('Location: Parking Lot A');
        $('#lockCount').text('Car Locked: ' + lockCount + ' times');
        $('#unlockCount').text('Car Unlocked: ' + unlockCount + ' times');
        $('#alarmCount').text('Alarm Triggered: ' + alarmCount + ' times');

        // Update the current status text based on the current state of the car
        if (carStatus === 'locked') {
            $('#currentStatus').text('Status: Locked').css('color', 'green');
        } else if (carStatus === 'unlocked') {
            $('#currentStatus').text('Status: Unlocked').css('color', 'red');
        }
        else if (carStatus === 'Alarm triggered') {
            $('#currentStatus').text('Status: Alarm Triggered').css('color', 'orange');
        }
    }

    // Call to update car statistics on page load
    updateCarStatistics();

    // Handle locking the car
    $('#lockCar').on('click', function() {
        carStatus = 'locked';  // Update the car status to locked
        lockCount++;  // Increment lock count
        $('#status').text('Car is locked!').css('color', 'green');
        updateCarStatistics();  // Update statistics
        // Implement Bluetooth lock function here
    });

    // Handle unlocking the car
    $('#unlockCar').on('click', function() {
        carStatus = 'unlocked';  // Update the car status to unlocked
        unlockCount++;  // Increment unlock count
        $('#status').text('Car is unlocked!').css('color', 'red');
        updateCarStatistics();  // Update statistics
        // Implement Bluetooth unlock function here
    });

    // Handle triggering the alarm
    $('#alarmCar').on('click', function() {
        alarmCount++;  // Increment alarm count
        $('#status').text('Alarm triggered!').css('color', 'orange');
        updateCarStatistics();  // Update statistics
        // Implement Bluetooth alarm function here
    });
});
