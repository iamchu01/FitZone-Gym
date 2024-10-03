<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Settings - HRMS admin template</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>

    <style>
        .dropdown-menu {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <?php include 'layouts/topbar.php'; ?>
        <?php include 'layouts/settings-sidebar.php'; ?>
        <?php include 'layouts/two-col-sidebar.php'; ?>

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <!-- Page Content -->
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <!-- Page Header -->
                        <div class="page-header">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3 class="page-title">Account Settings</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /Page Header -->
                        
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Account edit info<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Contact Person</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <div class="dropdown">
                                            <input type="text" class="form-control dropdown-toggle" id="countrySearch" placeholder="Search country..." data-bs-toggle="dropdown" aria-expanded="false">
                                            <ul class="dropdown-menu" id="countryList">
                                                <li class="p-2"><input type="text" class="form-control" id="countryFilter" placeholder="Search country..." onkeyup="filterCountries()"></li>
                                                <!-- Country options will be dynamically added here -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label>City</label>
                                        <div class="dropdown">
                                            <input type="text" class="form-control dropdown-toggle" id="citySearch" placeholder="Search city..." data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                            <ul class="dropdown-menu" id="cityList">
                                                <li class="p-2"><input type="text" class="form-control" id="cityFilter" placeholder="Search city..."></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label>State/Province</label>
                                        <div class="dropdown">
                                            <input type="text" class="form-control dropdown-toggle" id="provinceSearch" placeholder="Search state/province..." data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                            <ul class="dropdown-menu" id="provinceList">
                                                <li class="p-2"><input type="text" class="form-control" id="provinceFilter" placeholder="Search state/province..." onkeyup="filterProvinces()"></li>
                                                <!-- Province options will be dynamically added here -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input class="form-control" type="number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Website Url</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Wrapper -->
    </div>
    <!-- end main wrapper-->

    <?php include 'layouts/customizer.php'; ?>
    <!-- JAVASCRIPT -->
    <?php include 'layouts/vendor-scripts.php'; ?>

    <script>
        let countries = [];
        let provinces = [];

        // Fetch countries from the REST Countries API
        function fetchCountries() {
            fetch('https://restcountries.com/v3.1/all')
                .then(response => response.json())
                .then(data => {
                    countries = data.map(country => ({ name: country.name.common, code: country.cca2 })); // Extract country names and codes
                    populateCountries();
                })
                .catch(error => console.error('Error fetching countries:', error));
        }

        // Populate dropdown with country options
        function populateCountries() {
            const countryList = document.getElementById('countryList');
            countryList.innerHTML += countries.map(country => `<li><a class="dropdown-item" href="#" data-code="${country.code}" onclick="onCountrySelect('${country.code}')">${country.name}</a></li>`).join('');
        }

        // Filter countries based on user input
        function filterCountries() {
            const filter = document.getElementById('countryFilter').value.toLowerCase();
            const items = document.querySelectorAll('#countryList .dropdown-item');

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Fetch provinces from the Geonames API
        function fetchProvinces(countryCode) {
            // Replace with the actual Geoname ID for the country
            const geonameId = getGeonameId(countryCode); 
            const apiUrl = `http://api.geonames.org/administrativeDivisionsJSON?geonameId=${geonameId}&username=YOUR_USERNAME`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    provinces = data.adminCodes1.map(province => province.name); // Extract province names
                    populateProvinces();
                })
                .catch(error => console.error('Error fetching provinces:', error));
        }

        // Map country code to Geoname ID (you'll need to implement this based on your data)
        function getGeonameId(countryCode) {
            // Implement your mapping logic here
            return 'someGeonameId'; // Placeholder
        }

        // Populate dropdown with province options
        function populateProvinces() {
            const provinceList = document.getElementById('provinceList');
            provinceList.innerHTML = '<li class="p-2"><input type="text" class="form-control" id="provinceFilter" placeholder="Search state/province..." onkeyup="filterProvinces()"></li>' +
                                     provinces.map(province => `<li><a class="dropdown-item" href="#">${province}</a></li>`).join('');
        }

        // Filter provinces based on user input
        function filterProvinces() {
            const filter = document.getElementById('provinceFilter').value.toLowerCase();
            const items = document.querySelectorAll('#provinceList .dropdown-item');

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Handle country selection
        function onCountrySelect(countryCode) {
            const countryInput = document.getElementById('countrySearch');
            countryInput.value = countries.find(country => country.code === countryCode).name;
            document.getElementById('citySearch').disabled = false; // Enable city input
            document.getElementById('provinceSearch').disabled = false; // Enable province input
            fetchProvinces(countryCode); // Fetch provinces for selected country
        }

        // Initialize dropdown with country options
        document.addEventListener('DOMContentLoaded', fetchCountries);
    </script>

</body>
</html>
