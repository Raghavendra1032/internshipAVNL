const video = document.getElementById("video");
const canvas = document.getElementById("canvas");
const context = canvas.getContext("2d");

navigator.mediaDevices.getUserMedia({ video: true })
  .then(stream => {
    video.srcObject = stream;
  })
  .catch(err => console.error("Camera error:", err));

function capturePhoto() {
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  context.drawImage(video, 0, 0);
  canvas.style.display = "block";
  document.getElementById("retakeBtn").style.display = "inline-block";
}

function retakePhoto() {
  canvas.style.display = "none";
  document.getElementById("retakeBtn").style.display = "none";
}
document.getElementById("visitorForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);
  const jsonData = {};

  for (const [key, value] of formData.entries()) {
    jsonData[key] = value;
  }

  const photoData = canvas.toDataURL("image/jpeg");
  jsonData['photo'] = photoData;

  fetch("save_visitor.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(jsonData)
  })
  .then(response => response.json())
  .then(result => {
    if (result.success) {
      alert("Visitor saved successfully!");
      window.open("details.html?" + new URLSearchParams(jsonData).toString(), "_blank");
    } else {
      alert("Error: " + result.error);
    }
  })
  .catch(error => {
    console.error("Fetch error:", error);
  });
});

