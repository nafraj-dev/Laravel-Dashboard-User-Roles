const puppeteer = require('puppeteer');

(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    const email = 'nafees@skylitemail.com';   // Replace with the actual email
    const password = '@sDF70070';              // Replace with the actual password

    await page.goto('https://www.facebook.com/login');

    await page.type('#email', email);
    await page.type('#pass', password);

    await page.click('#loginbutton');
    await page.waitForNavigation();

    console.log(page.url());

    await browser.close();
})();
