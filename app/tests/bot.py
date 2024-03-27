from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import WebDriverWait
from webdriver_manager.chrome import ChromeDriverManager

browsercfg = webdriver.ChromeOptions()


browsercfg.add_argument("--log-level=OFF")

driver_path = ChromeDriverManager().install()
browser_service = Service(executable_path=driver_path)
browser = webdriver.Chrome(browsercfg, browser_service)


browser.get("http://localhost/Evaluation-System/")
input("")
