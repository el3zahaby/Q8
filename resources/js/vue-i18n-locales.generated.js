(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
        typeof define === 'function' && define.amd ? define(factory) :
            typeof global.vuei18nLocales === 'undefined' ? global.vuei18nLocales = factory() : Object.keys(factory()).forEach(function (key) {
                global.vuei18nLocales[key] = factory()[key]
            });
}(this, (function () {
    'use strict';
    return {
        AR: {
            Home: "الصفحة الرئسية",
            Login: "الدخول",
            Logout: "الخروج",
            Register: "تسجيل",
            Profile: "الحساب",
            search: "ابحث",

            //Cart page
            view_cart: "شاهد حقيبتك",
            ProductsName: "اسم المنتج",
            Products: " المنتجات",
            price: "السعر",
            quantity: " الكمية",
            total: " المجموع",
            update: "تعديل",
            continue_shopping: "استمر في التسوق",
            checkout: "الدفع",
            cart_total: "مجموع المشتريات",
            sub_total: "المجموع الكلي",
            tax: "الضريبة",
            shipping: "مصاريف الشحن",
            order_total: "مجموع الطلبات",
            code: "ادخل كود الخصم",
            enter: "ادخل",
            Billing_Details: "تفاصيل الفاتورة",
            Payment_Methods: "طريقة الدفع",
            delivery: "الدفع عند الإستلام",
            Placeorder: "مكان الطلب",
            Your_order: "طلبك",
            //Login & Register
            Full_Name: "الاسم كامل",
            Email: "البريد الالكتروني",
            Username: "اسم المستخدم",
            Phone_Number: "رقم الهاتف",
            Password: "الرقم السري",
            Address: "العنوان",
            Remember_me: "تذكرني",
            Forgot_Password: "هل نسيت كلمة المرور؟",
            Register_as_Designer: "التسجيل كمصمم",
            //Product_details
            print_options: "خيارات الطباعه",
            Front: "من الأمام",
            Back: "من الخلف",
            Front_and_Back: "من الأمام و الخلف",
            front_size: "حجم الطباعه من الأمام",
            back_size: "حجم الطباعه من الخلف",
            TShirt_Color: "لون التيشيرت",
            TShirt_Size: "حجم التشيرت",
            Please_Select: "اختر",
            Add_to_cart: "اضيف إلي حقيبتك",
            //======================= Dashboard =======================
            Welcome: "مرحبا",
            Dashboard: "لوحة التحكم",
            Designs: "الرسمات",
            MostSells: "الاكثر مبيعا",
            Personal_info: "معلوماتك الشخصية",
            Overview: "نظرة عامة",
            latest_Designs: "رسماتك الأخيره",
            Design: "الرسمه",
            Design_Name: "اسم الرسمه",
            Design_Rondom_ID: "رقم عشوائى للرسمه",
            Design_Price: "سعر الرسمه",
            delete: "حذف",
            Designs_Number: "عدد الرسمات",
            Sales_Number: "عدد المبيعات",
            Sales_Price: "سعر المبيعات",
            Add_New_Design: "اضف رسمه جديدة",
            New_Design: "رسمه جديدة",
            Choose_Design_img: "اختر رسمه",
            Close: "اغلاق",
            Add_Design: "اضف رسمه",
            First_Name: "الاسم الاول",
            Last_Name: "الاسم الاخير",
            Age: "العمر",
            Bank_Name: "اسم البنك",
            Bank_IBAN: "اي بي ان البنك",
            Your_Name_on_Bank_Card: "اسمك علي بطاقة البنك",
            Save_Changes: "حفظ التغيرات",
            Cancel: "الغاء",
            //==================================Footer=================
            Helpful_Links: "روابط مفيدة",
            Payment: "الدفع",
            Accepted_Cards: "البطاقات المقبولة"
        },
        EN: {
            search: "search",
            // Cart
            view_cart: "view cart",
            ProductsName: "Products Name",
            Products: " Products",
            price: "price",
            quantity: " quantity",
            total: " total",
            update: "update",
            continue_shopping: "continue shopping",
            checkout: "checkout",
            cart_total: "cart total",
            sub_total: "sub total",
            tax: "tax",
            shipping: "shipping ",
            order_total: " order total",
            code: "enter your discount code",
            enter: "enter",
            Payment_Methods: "Payment Methods",
            delivery: "Cash on delivery",
            Placeorder: "Place order",
            Your_order: "Your order",

            //Login & Register
            Login: "Login",
            Logout: "Log Out",
            Register: "Register",
            Full_Name: "Full Name",
            Phone_Number: "Phone Number",
            Email: "Email",
            Username: "Username",
            Password: "Password",
            Address: "Address",
            Remember_me: "Remember_me",
            Forgot_Password: "Forgot_Password",
            Register_as_Designer: "Register as Designer",
            Billing_Details: "Billing Details",

            //Product_details
            print_options: "print options",
            Front: "Front",
            Back: "Back",
            Front_and_Back: "Front and Back",
            front_size: "front size",
            back_size: "back size",
            TShirt_Color: "T-Shirt Color",
            TShirt_Size: "T-Shirt Size",
            Please_Select: "Please Select",
            Add_to_cart: "Add to cart",
            //======================= Dashboard =======================
            Welcome: "Welcome",
            Dashboard: "Dashboard",
            MostSells: "Most Sells",
            Profile: "Profile",
            Personal_info: "Personal info",
            Overview: "Overview",
            latest_Designs: "latest Designs",
            Designs: "Designs",
            Design: "Design",
            Design_Name: "Design Name",
            Design_Rondom_ID: "Design Rondom ID",
            Design_Price: "Design Price",
            delete: "delete",
            Designs_Number: "Designs Number",
            Sales_Number: "Sales Number",
            Sales_Price: "Sales Price",
            Add_New_Design: "Add_New_Design",
            New_Design: "New Design",
            Choose_Design_img: "Choose Design img",
            Close: "Close",
            Add_Design: "Add Design",
            First_Name: "First Name",
            Last_Name: "Last Name",
            Age: "Age",
            Bank_Name: "Bank Name",
            Bank_IBAN: "Bank IBAN",
            Your_Name_on_Bank_Card: "Your Name on Bank Card",
            Save_Changes: "Save Changes",
            Cancel: "Cancel",
            //==================================Footer=================
            Helpful_Links: "Helpful Links",
            Payment: "Payment",
            Accepted_Cards: "Accepted Cards",

            //=========================================================
            auth: {
                failed: "These credentials do not match our records.",
                throttle:
                    "Too many login attempts. Please try again in {seconds} seconds."
            },
            pagination: {
                previous: "&laquo; Previous",
                next: "Next &raquo;"
            },
            passwords: {
                password:
                    "Passwords must be at least eight characters and match the confirmation.",
                reset: "Your password has been reset!",
                sent: "We have e-mailed your password reset link!",
                token: "This password reset token is invalid.",
                user: "We can't find a user with that e-mail address."
            },
            validation: {
                accepted: "The {attribute} must be accepted.",
                active_url: "The {attribute} is not a valid URL.",
                after: "The {attribute} must be a date after {date}.",
                after_or_equal:
                    "The {attribute} must be a date after or equal to {date}.",
                alpha: "The {attribute} may only contain letters.",
                alpha_dash:
                    "The {attribute} may only contain letters, numbers, dashes and underscores.",
                alpha_num:
                    "The {attribute} may only contain letters and numbers.",
                array: "The {attribute} must be an array.",
                before: "The {attribute} must be a date before {date}.",
                before_or_equal:
                    "The {attribute} must be a date before or equal to {date}.",
                between: {
                    numeric: "The {attribute} must be between {min} and {max}.",
                    file:
                        "The {attribute} must be between {min} and {max} kilobytes.",
                    string:
                        "The {attribute} must be between {min} and {max} characters.",
                    array:
                        "The {attribute} must have between {min} and {max} items."
                },
                boolean: "The {attribute} field must be true or false.",
                confirmed: "The {attribute} confirmation does not match.",
                date: "The {attribute} is not a valid date.",
                date_equals: "The {attribute} must be a date equal to {date}.",
                date_format:
                    "The {attribute} does not match the format {format}.",
                different: "The {attribute} and {other} must be different.",
                digits: "The {attribute} must be {digits} digits.",
                digits_between:
                    "The {attribute} must be between {min} and {max} digits.",
                dimensions: "The {attribute} has invalid image dimensions.",
                distinct: "The {attribute} field has a duplicate value.",
                email: "The {attribute} must be a valid email address.",
                ends_with:
                    "The {attribute} must end with one of the following: {values}",
                exists: "The selected {attribute} is invalid.",
                file: "The {attribute} must be a file.",
                filled: "The {attribute} field must have a value.",
                gt: {
                    numeric: "The {attribute} must be greater than {value}.",
                    file:
                        "The {attribute} must be greater than {value} kilobytes.",
                    string:
                        "The {attribute} must be greater than {value} characters.",
                    array: "The {attribute} must have more than {value} items."
                },
                gte: {
                    numeric:
                        "The {attribute} must be greater than or equal {value}.",
                    file:
                        "The {attribute} must be greater than or equal {value} kilobytes.",
                    string:
                        "The {attribute} must be greater than or equal {value} characters.",
                    array: "The {attribute} must have {value} items or more."
                },
                image: "The {attribute} must be an image.",
                in: "The selected {attribute} is invalid.",
                in_array: "The {attribute} field does not exist in {other}.",
                integer: "The {attribute} must be an integer.",
                ip: "The {attribute} must be a valid IP address.",
                ipv4: "The {attribute} must be a valid IPv4 address.",
                ipv6: "The {attribute} must be a valid IPv6 address.",
                json: "The {attribute} must be a valid JSON string.",
                lt: {
                    numeric: "The {attribute} must be less than {value}.",
                    file:
                        "The {attribute} must be less than {value} kilobytes.",
                    string:
                        "The {attribute} must be less than {value} characters.",
                    array: "The {attribute} must have less than {value} items."
                },
                lte: {
                    numeric:
                        "The {attribute} must be less than or equal {value}.",
                    file:
                        "The {attribute} must be less than or equal {value} kilobytes.",
                    string:
                        "The {attribute} must be less than or equal {value} characters.",
                    array:
                        "The {attribute} must not have more than {value} items."
                },
                max: {
                    numeric: "The {attribute} may not be greater than {max}.",
                    file:
                        "The {attribute} may not be greater than {max} kilobytes.",
                    string:
                        "The {attribute} may not be greater than {max} characters.",
                    array: "The {attribute} may not have more than {max} items."
                },
                mimes: "The {attribute} must be a file of type: {values}.",
                mimetypes: "The {attribute} must be a file of type: {values}.",
                min: {
                    numeric: "The {attribute} must be at least {min}.",
                    file: "The {attribute} must be at least {min} kilobytes.",
                    string:
                        "The {attribute} must be at least {min} characters.",
                    array: "The {attribute} must have at least {min} items."
                },
                not_in: "The selected {attribute} is invalid.",
                not_regex: "The {attribute} format is invalid.",
                numeric: "The {attribute} must be a number.",
                present: "The {attribute} field must be present.",
                regex: "The {attribute} format is invalid.",
                required: "The {attribute} field is required.",
                required_if:
                    "The {attribute} field is required when {other} is {value}.",
                required_unless:
                    "The {attribute} field is required unless {other} is in {values}.",
                required_with:
                    "The {attribute} field is required when {values} is present.",
                required_with_all:
                    "The {attribute} field is required when {values} are present.",
                required_without:
                    "The {attribute} field is required when {values} is not present.",
                required_without_all:
                    "The {attribute} field is required when none of {values} are present.",
                same: "The {attribute} and {other} must match.",
                size: {
                    numeric: "The {attribute} must be {size}.",
                    file: "The {attribute} must be {size} kilobytes.",
                    string: "The {attribute} must be {size} characters.",
                    array: "The {attribute} must contain {size} items."
                },
                starts_with:
                    "The {attribute} must start with one of the following: {values}",
                string: "The {attribute} must be a string.",
                timezone: "The {attribute} must be a valid zone.",
                unique: "The {attribute} has already been taken.",
                uploaded: "The {attribute} failed to upload.",
                url: "The {attribute} format is invalid.",
                uuid: "The {attribute} must be a valid UUID.",
                custom: {
                    "attribute-name": {
                        "rule-name": "custom-message"
                    }
                },
                attributes: []
            }
        }
    };

})));
