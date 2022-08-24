let voices = speechSynthesis.getVoices()
speechSynthesis.addEventListener("voiceschanged", () => {
    voices = speechSynthesis.getVoices()
    voices.forEach((e, i) => {
        voz_es.innerHTML += `
        <option value="${i}">${e.name}</option>
        `
        voz_in.innerHTML += `
        <option value="${i}">${e.name}</option>
        `
        // if (e.name === "Microsoft Dalia Online (Natural) - Spanish (Mexico)"){
        //     console.log(e.name)
        //     voz_es.value = 2
        // }
    })
})