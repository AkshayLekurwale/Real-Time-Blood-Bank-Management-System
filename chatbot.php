<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['reply' => 'Method not allowed.']);
    exit;
}

// Get user input
$input = json_decode(file_get_contents("php://input"), true);
$message = strtolower(trim($input['message'] ?? ''));

// Simple rule-based replies
$replies = [
    "hi" => "Hello! How can I assist you today?",
    "hello" => "Hi there! Need help with blood donation?",
    "how are you" => "I'm just code, but I'm here to help!",
    "who can donate blood" => "Anyone healthy, aged 18–65, can usually donate blood.",
    "where can i donate blood" => "You can donate at nearby blood banks or hospitals.",
    "bye" => "Goodbye! Take care and consider donating blood!",
    "what is blood donation" => "Blood donation is the process of voluntarily giving blood to help those in need. It can save lives during surgeries, accidents, or medical conditions.",
    "why to donate blood" => "Donating blood is a noble act that helps save lives. One donation can help multiple patients in need.",
    "how often can i donate blood" => "You can donate whole blood every 56 days (8 weeks) and platelet donations every 7 days, up to 24 times a year.",
    "is blood donation safe" => "Yes, blood donation is a safe procedure carried out under hygienic conditions by trained medical staff.",
    "what type of blood is needed" => "All blood types are needed, but some are more commonly in demand depending on the region. It’s always good to check with local blood banks.",
    "how much blood is taken during donation" => "Typically, about 1 pint (500 mL) of blood is taken during a donation, which is safe for most healthy adults.",
    "can i donate blood if i have a medical condition" => "It depends on the condition. It’s best to consult with a doctor before donating if you have any medical concerns.",
    "how do i prepare for blood donation" => "Eat a healthy meal, stay hydrated, and avoid heavy exercise before donating blood.",
    "is there an age limit for donating blood" => "You must be at least 18 years old and not older than 65, though some blood donation organizations may allow older individuals depending on their health.",
    "can i donate blood if i’m on medication" => "It depends on the type of medication you're taking. Consult with your doctor or the blood bank to find out if you’re eligible.",
    "what happens after i donate blood" => "After donating blood, you will be given refreshments and asked to rest for a few minutes. You can resume your normal activities after a short recovery period.",
    "can i donate blood if i'm pregnant" => "Pregnant women should not donate blood. However, if you are planning to donate, it is recommended to wait until after childbirth.",
    "is my blood safe to donate" => "As long as you’re in good health, have no serious medical conditions, and are within the required age and weight limits, your blood should be safe to donate.",
    "where does donated blood go" => "Donated blood is sent to hospitals and clinics to help patients undergoing surgery, cancer treatment, accident recovery, or those in need of blood transfusions.",
    "how do i become a regular blood donor" => "To become a regular donor, you can visit a local blood bank or sign up for donation events, and they will remind you when it’s time for your next donation.",
    "what should i avoid after donating blood" => "After donating blood, avoid strenuous activities for the rest of the day. Rest and drink plenty of fluids to rehydrate.",
    "how do i know if i’m eligible to donate blood" => "Eligibility depends on factors like age, weight, health, and medical history. You can check with a local blood bank to find out if you're eligible.",
    "can i donate blood if i have tattoos" => "If your tattoo was done at a licensed establishment and healed properly, you can donate blood. However, you may be asked to wait 6 months after getting a new tattoo.",
    "do i need to make an appointment to donate blood" => "It’s recommended to make an appointment at local donation centers or blood drives to ensure availability, but walk-ins are usually welcome too.",
    "what should i do if i feel faint after donating blood" => "If you feel faint, lie down and elevate your feet. Let the medical staff know so they can assist you and ensure you're feeling better."];

    // Default response if no match is found
    $response = "I'm sorry, I don't understand. Can you please ask something else?";
    
    // Search for reply
    foreach ($replies as $key => $value) {
        if (strpos($message, $key) !== false) {
            $response = $value;
            break;
        }
    }
    
    // Return the response as JSON
    echo json_encode(['reply' => $response]);
    exit;
    ?>