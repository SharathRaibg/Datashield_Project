async function submitData() {

    const data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        phone: document.getElementById("phone").value,
        department: document.getElementById("department").value,
        address: document.getElementById("address").value
    };

    try {
        const response = await fetch(
            "https://0y96azknd3.execute-api.ap-south-2.amazonaws.com/submit.php",
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            }
        );

        const result = await response.text();

        document.getElementById("message").innerHTML = result;

        // Refresh only if the request succeeded
        if (response.ok) {
            setTimeout(() => {
                location.reload();
            }, 1500); // Refresh after 1.5 seconds
        }

    } catch (error) {
        console.error(error);

        document.getElementById("message").innerHTML =
            "Error connecting to server.";
    }
}