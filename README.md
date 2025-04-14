# Shopreviews.com integration for Magento® 2

The official Magento 2 plugin for Shopreviews.com.

## Installation

#### Magento® Marketplace

This extension will be available on the Marketplace soon.

#### Install via Composer

1. Go to Magento® 2 root folder

2. Enter the following commands to install module:

   ```
   composer require shopreviews-com/magento2
   ``` 

3. Enter following commands to enable module:

   ```
   php bin/magento module:enable Shopreviews_Connect
   php bin/magento setup:upgrade
   php bin/magento cache:clean
   ```

4. If Magento® is running in production mode, deploy static content with the following command: 

   ```
   php bin/magento setup:static-content:deploy
   ```


## Supported Review Platforms
|  | Platform | Status |
|------|----------|--------|
| <img src="https://github.com/user-attachments/assets/fc3096fa-f5ee-4a15-8535-77753eaf0287" width="50" alt="Ebay logo" /> | eBay Marketplace Reviews | ✅ Live |
| <img src="https://github.com/user-attachments/assets/294d496b-1910-4438-8eee-476d4f1b5bcc" width="50" alt="Google logo" /> | Google Business Reviews | ✅ Live |
| <img src="https://github.com/user-attachments/assets/67d7bdc2-e0a9-47c6-952c-6b81861c48ed" width="50" alt="TrustPilot Logo" /> | TrustPilot Reviews | ✅ Live |
| <img src="https://github.com/user-attachments/assets/4485c3e4-5649-4122-aba7-afd9aa16eeff" width="50" alt="Kiyoh logo" /> | Kiyoh Reviews | ✅ Live |
| <img src="https://github.com/user-attachments/assets/6ca2e21e-4315-46d5-a2c9-e52e64604cbb" width="50" alt="Yellow Pages" /> | Yellow Pages Reviews | ✅ Live |
| <img src="https://github.com/user-attachments/assets/ff1c9b3b-1ec8-438b-a4f9-22908e2876bf" width="50" alt="Ekomi logo" /> | Ekomi Reviews | ✅ Live |
| <img src="https://github.com/user-attachments/assets/29047e6b-3e28-4b99-b5c4-f08dfa23a060" width="50" alt="WebwinkelKeur logo" /> | WebwinkelKeur Reviews | ✅ Live |
| <img src="https://github.com/user-attachments/assets/4c1a187b-2f64-4f50-b219-d1302233f599" width="50" alt="FeedbackCompany logo" /> | FeedbackCompany Reviews | ✅ Live |
| <img src="https://github.com/user-attachments/assets/d3e68896-81ed-4526-9cfe-5d255fd3466f" width="50" alt="Facebook logo" /> | Facebook Business Reviews | ✅ Live |
| <img src="https://github.com/user-attachments/assets/2c377d29-98dc-4f6e-b669-87466e8f7702" width="50" alt="TrustedShops logo" /> | TrustedShops Reviews | ✅ Live |
| <img src="https://github.com/user-attachments/assets/2c3ec7f7-8a8d-4ca9-888c-b556c2ac0570" width="50" alt="Etsy logo" /> | Etsy Marketplace Reviews  | ✅ Live |
| <img src="https://github.com/user-attachments/assets/4da96d5c-3f8a-45eb-923c-f157baf2be05" width="50" alt="Stamped logo" /> | Stamped Reviews | ✅ Live |
