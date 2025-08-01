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
  const params = new URLSearchParams();

  for (const [key, value] of formData.entries()) {
    params.append(key, value);
  }

  // Add photo
  const photoData = canvas.toDataURL("image/jpeg");
  params.append("photo", photoData);

  window.location.href = `details.html?${params.toString()}`;
});
