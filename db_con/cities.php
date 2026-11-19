<?php
/**
 * Centralized list of Indian cities and dropdown options helper.
 */

function get_indian_cities() {
    $cities = [
        "Ahmedabad",
        "Agra",
        "Ajmer",
        "Aligarh",
        "Allahabad",
        "Amritsar",
        "Bareilly",
        "Bengaluru",
        "Bhopal",
        "Bhubaneswar",
        "Chandigarh",
        "Chennai",
        "Coimbatore",
        "Dehradun",
        "Delhi",
        "Faridabad",
        "Ghaziabad",
        "Guntur",
        "Gurgaon",
        "Guwahati",
        "Gwalior",
        "Howrah",
        "Hyderabad",
        "Indore",
        "Jabalpur",
        "Jaipur",
        "Jalandhar",
        "Jodhpur",
        "Kochi",
        "Kolkata",
        "Kota",
        "Lucknow",
        "Ludhiana",
        "Madurai",
        "Meerut",
        "Mumbai",
        "Mysore",
        "Nagpur",
        "Nashik",
        "Noida",
        "Patna",
        "Pune",
        "Raipur",
        "Rajkot",
        "Ranchi",
        "Salem",
        "Solapur",
        "Srinagar",
        "Surat",
        "Thane",
        "Udaipur",
        "Vadodara",
        "Varanasi",
        "Vijayawada",
        "Warangal"
    ];
    
    // Ensure sorted alphabetically
    sort($cities);
    return $cities;
}

function render_city_options($selected_city = '') {
    $cities = get_indian_cities();
    $html = '';
    
    // Trim selected city for comparison
    $selected_city = trim($selected_city);
    
    foreach ($cities as $city) {
        $selected = (strcasecmp($city, $selected_city) == 0) ? 'selected' : '';
        $html .= '<option value="' . htmlspecialchars($city) . '" ' . $selected . '>' . htmlspecialchars($city) . '</option>' . "\n";
    }
    return $html;
}
