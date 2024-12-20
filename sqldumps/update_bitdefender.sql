UPDATE products
SET
    category_id = 12,
    product_name = 'Bitdefender Mobile Security for Android',
    product_plan_name = 'Mobile Security for Android',
    description = '1 user',
    reviews = 0,
    discount_percentage = NULL,
    compatibility = '["Android"]',
    benefits = '["Automatically scans any application that you install.", 
                "You can see what each app is capable of doing on your device.", 
                "You can restrict access to any app by setting a passcode for it.", 
                "You can remotely locate, lock, wipe, or send a message to a stolen device."]',
    learn_more_link = 'https://www.bitdefender.com/pages/consumer/en/new/ps-opt?force_country=us&cid=ppc|c|google|60off&gad_source=1&gclid=EAIaIQobChMIhJer-fKhiQMVH6ODBx21gDVuEAAYASACEgKypfD_BwE',
    product_link = 'https://www.bitdefender.com/pages/consumer/en/new/ps-opt?force_country=us&cid=ppc|c|google|60off&gad_source=1&gclid=EAIaIQobChMIhJer-fKhiQMVH6ODBx21gDVuEAAYASACEgKypfD_BwE',
    price = 500,
    price_offer = 500,
    price_partner = 500,
    stock_status = 'instock',
    quantity = 0,
    image_url = 'http://localhost:8000/assets/img/bitdefender.png',
    updated_at = NOW(),
    commission_percentage = 8.00,
    last_updated_at = NULL
WHERE id = 6;
