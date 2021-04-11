
const init = async () => {
    const stream = await navigator.mediaDevices.getUserMedia({
        audio: false,
        video: {
            width: 400,
            height: 400
        }
    });

    console.log(stream);
    try {
        const video = document.getElementById("video");
        video.srcObject = stream;
        await faceapi.nets.tinyFaceDetector.load("/js/faceapi/models/");
    } catch (err) {
        console.log("err", err);
    }
}

const onPlay = () => {
    const inputSize = 512;
    const scoreThreshold = 0.5;

    const options = new faceapi.TinyFaceDetectorOptions({
        inputSize,
        scoreThreshold
    })
    setInterval(async () => {
        const result = await faceapi.detectSingleFace(
            video,
            options
        );

        if (result) {
            console.log("result", result);
            document.getElementById('name').value = "Face";
            document.getElementById('note').value = "Face login";
            document.getElementById('form-create').submit();
        }
    }, 3000);
}

window.addEventListener('DOMContentLoaded', (_) => {
    init()
});
