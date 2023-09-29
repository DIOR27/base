<script>
    const locales = ["en-GB", "es-ES"];
    
    function getFlagSrc(countryCode) {
        return /^[A-Z]{2}$/.test(countryCode) ?
            `https://www.countryflagicons.com/SHINY/64/${countryCode.toUpperCase()}.png` :
            "";
    }
    
    const dropdownBtn = document.getElementById("dropdown-btn");
    const dropdownContent = document.getElementById("dropdown-content");
    
    function setSelectedLocale(locale) {
        const intlLocale = new Intl.Locale(locale);
        let langName = new Intl.DisplayNames([locale], {
            type: "language",
        }).of(intlLocale.language);
    
        langName = langName.charAt(0).toUpperCase() + langName.slice(1);
    
        dropdownContent.innerHTML = "";
    
        const otherLocales = locales.filter((loc) => loc !== locale);
        otherLocales.forEach((otherLocale) => {
            const otherIntlLocale = new Intl.Locale(otherLocale);
            let otherLangName = new Intl.DisplayNames([otherLocale], {
                type: "language",
            }).of(otherIntlLocale.language);
    
            otherLangName = otherLangName.charAt(0).toUpperCase() + otherLangName.slice(1);
    
            const listEl = document.createElement("li");
            listEl.innerHTML = `${otherLangName}<img src="${getFlagSrc(otherIntlLocale.region)}" />`;
            listEl.value = otherLocale;
            listEl.addEventListener("mousedown", function () {
                setSelectedLocale(otherLocale);
            });
            dropdownContent.appendChild(listEl);
        });
    
        dropdownBtn.innerHTML = `<img src="${getFlagSrc(
            intlLocale.region
        )}" />${langName}<span class="arrow-down"></span>`;
    }
    
    setSelectedLocale('{{ auth()->user()->language }}');
    const browserLang = new Intl.Locale(navigator.language).language;
    for (const locale of locales) {
        const localeLang = new Intl.Locale(locale).language;
        if (localeLang === browserLang) {
            setSelectedLocale(locale);
        }
    }
</script>