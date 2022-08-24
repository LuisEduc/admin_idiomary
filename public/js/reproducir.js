const voces = []

function setSpeech() {
    return new Promise(
        function (resolve, reject) {
            let synth = window.speechSynthesis;
            synth.addEventListener("voiceschanged", () => {
                resolve(synth.getVoices());
            })
        }
    )
}

let s = setSpeech();
s.then((voices) => {
    
    voices.forEach((e, i) => {
        if (e.name === "Microsoft Dalia Online (Natural) - Spanish (Mexico)") {
            voz_es.innerHTML += `
            <option selected value="${i}">${e.name}</option>
            `
        } else {
            e.name.includes('Spanish')?
            voz_es.innerHTML += `
            <option value="${i}">${e.name}</option>
            `
            :''
        }

        if (e.name === "Microsoft Clara Online (Natural) - English (Canada)") {
            voz_in.innerHTML += `
            <option selected value="${i}">${e.name}</option>
            `
        } else {
            e.name.includes('English')?
            voz_in.innerHTML += `
            <option value="${i}">${e.name}</option>
            `
            :''
        }
    })

    const queryp_es = document.querySelectorAll('.p_es');
    const p_es = [...queryp_es].map(input => input.innerHTML);
    const queryp_in = document.querySelectorAll('.p_in');
    const p_in = [...queryp_in].map(input => input.innerHTML);

    const queryt_es = document.querySelectorAll('.t_es');
    const t_es = [...queryt_es].map(input => input.innerHTML);
    const queryt_in = document.querySelectorAll('.t_in');
    const t_in = [...queryt_in].map(input => input.innerHTML);

    const queryf_es = document.querySelectorAll('.f_es');
    const f_es = [...queryf_es].map(input => input.innerHTML);
    const queryf_in = document.querySelectorAll('.f_in');
    const f_in = [...queryf_in].map(input => input.innerHTML);


    let voice_es = voz_es.value
    let voice_in = voz_in.value

    btnplay.addEventListener("click", () => {
        voice_es = voz_es.value
        voice_in = voz_in.value
        console.log(voice_in)
        console.log(voice_es)
        leccion = [
            {
                text: `Las palabras de hoy son`,
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            {
                text: `${p_in[0]} . !, ${p_in[0]} . !, ${p_in[1]} . !, ${p_in[1]} . !, ${p_in[2]} . !, ${p_in[2]} . !`,
                lang: 'en-US',
                voice: voice_in,
                rate: 0.2,
                volume: 0.8,
            },
            {
                text: `Ahora vamos a practicar cada una de ellas. Comensemos . ! `,
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            // PRIMERA PALABRA #######################
            {
                text: 'Palabra del nivel básico . !',
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            {
                text: `${p_in[0]} . ! ${p_in[0]} . ! ${p_in[0]}`,
                lang: 'en-US',
                voice: voice_in,
                rate: 0.2,
                volume: 0.8,
            },
            {
                text: `es un ${t_es[0]} que significa ${p_es[0]} . !`,
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            {
                text: `La frase de ejemplo, ${f_es[0]}, se traduse a.`,
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            {
                text: `${f_in[0]}  . ! ${f_in[0]}  . !`,
                lang: 'en-US',
                voice: voice_in,
                rate: 0.2,
                volume: 0.8,
            },
            // SEGUNDA PALABRA #######################
            {
                text: 'Palabra del nivel medio . !',
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            {
                text: `${p_in[1]} . ! ${p_in[1]} . ! ${p_in[1]}`,
                lang: 'en-US',
                voice: voice_in,
                rate: 0.2,
                volume: 0.8,
            },
            {
                text: `es un ${t_es[1]} que significa ${p_es[1]} . !`,
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            {
                text: `La frase de ejemplo, ${f_es[1]}, se traduse a.`,
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            {
                text: `${f_in[1]}  . ! ${f_in[1]}  . !`,
                lang: 'en-US',
                voice: voice_in,
                rate: 0.2,
                volume: 0.8,
            },
            // TERCERA PALABRA #######################
            {
                text: 'Palabra del nivel avansado. !',
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            {
                text: `${p_in[2]} . ! ${p_in[2]} . ! ${p_in[2]}`,
                lang: 'en-US',
                voice: voice_in,
                rate: 0.2,
                volume: 0.8,
            },
            {
                text: `es un ${t_es[2]} que significa ${p_es[2]} . !`,
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            {
                text: `La frase de ejemplo, ${f_es[2]}, se traduse a.`,
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
            {
                text: `${f_in[2]}  . ! ${f_in[2]}  . !`,
                lang: 'en-US',
                voice: voice_in,
                rate: 0.2,
                volume: 0.8,
            },
            {
                text: `Fin de la lecsión . En inglés por día, aprende inglés todos los días`,
                lang: 'es-MX',
                voice: voice_es,
                rate: 0.8,
                volume: 0.5,
            },
        ];

        speechSynthesis.cancel();
        leccion.forEach(element => {
            const text = element.text;
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = element.lang;
            utterance.rate = element.rate;
            utterance.volume = element.volume;
            utterance.voice = voices[element.voice];
            speechSynthesis.speak(utterance);
        })
    })

    btnstop.addEventListener("click", () => {
        speechSynthesis.cancel();
    })

})