<?php if (!isset($active)) $active = ''; ?>
<html>
<head>
  <style>
    .header {
      overflow: hidden;
      background-color: #333;
      top: 0;
      width: 100%;
      padding: 10px 5px;
      color: #FF0404;
    }

    .header a {
      float: left;
      color: white;
      text-align: center;
      padding: 12px;
      text-decoration: none;
      font-size: 18px;
      line-height: 25px;
      border-radius: 4px;
      font-weight: bold;
    }

    .header a.logo {
      font-size: 25px;
      font-weight: bold;
      color: #FF0404;
    }

    .header a:hover {
      background-color: #ddd;
      color: black;
    }

    .header-right {
      float: right;
    }

    @media screen and (max-width: 500px) {
      .header a {
        float: none;
        display: block;
        text-align: left;
      }

      .header-right {
        float: none;
      }
    }

    a.act {
      background: linear-gradient(to right, #fd746c 0%, #ff9068 100%);
      color: white;
      border-radius: 30px;
    }

    a.logo2 {
      background-color: #333;
    }
  </style>
</head>

<body>
  <div class="header">
    <a href="home.php" class="logo"<?php if($active=='home') echo " class='logo2'"; ?>>Blood Bank & Donation</a>
    <div class="header-right">
      <a href="about_us.php"  <?php if($active=='about') echo "class='act'"; ?>>About Us</a>
      <a href="why_donate_blood.php"  <?php if($active=='why') echo "class='act'"; ?>>Why Donate Blood</a>
      <a href="donate_blood.php"  <?php if($active=='donate') echo "class='act'"; ?>>Become A Donor</a>
      <a href="need_blood.php" <?php if($active=='need') echo "class='act'"; ?>>Hospital</a>
      <a href="blood_bank.php" <?php if($active=='bank') echo "class='act'"; ?>>Blood Bank</a>
      <a href="contact_us.php" <?php if($active=='contact') echo "class='act'"; ?>>Contact Us</a>
      <a id="chatbot-toggle" style="cursor: pointer;" title="Chat with us">🤖 Chatbot</a>
    </div>
  </div>
<!-- Chatbot Window -->
<div id="chatbot-window" style="display: none; position: fixed; bottom: 80px; right: 20px; width: 350px; height: 500px; background: #333; border: 1px solid #ccc; border-radius: 10px; overflow: hidden; z-index: 1000;">
    <div id="chat-box" style="height: 400px; overflow-y: auto; padding: 10px; border-bottom: 1px solid #444; background-color: #222; color: white;"></div>
    <div style="padding: 10px; display: flex; align-items: center;">
        <input type="text" id="chat-input" placeholder="Ask something..." style="width: 80%; padding: 10px; border: 1px solid #555; border-radius: 5px; margin-right: 10px; background-color: #444; color: white;">
        <button id="send-button" style="width: 20%; padding: 10px 15px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Send</button>
    </div>
</div>

<script>
    // Toggle the chatbot window
    document.getElementById("chatbot-toggle").onclick = function () {
      var win = document.getElementById("chatbot-window");
      win.style.display = win.style.display === "none" ? "block" : "none";
    };

    // Handle sending messages in the chat window
    document.getElementById('send-button').addEventListener('click', async function () {
        const input = document.getElementById('chat-input');
        const message = input.value.trim();
        if (!message) return;

        // Display user's message in the chat box
        const chatBox = document.getElementById('chat-box');
        chatBox.innerHTML += `<div><strong style="color: #4CAF50;">You:</strong> ${message}</div>`;
        input.value = "";

        try {
            // Send the POST request to chatbot.php
            const response = await fetch('chatbot.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message })
            });

            const data = await response.json();
            chatBox.innerHTML += `<div><strong style="color: #FF9800;">Bot:</strong> ${data.reply}</div>`;
            chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom
        } catch (error) {
            console.error('Error:', error);
            chatBox.innerHTML += `<div><strong style="color: #FF9800;">Bot:</strong> Error connecting to chatbot.</div>`;
        }
    });
</script>



</body>
</html>
