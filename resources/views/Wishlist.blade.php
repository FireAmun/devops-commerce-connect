<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Wishlist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --success-color: #059669;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-700: #374151;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: var(--gray-100);
            margin: 0;
            padding: 0;
            color: var(--gray-700);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            padding: 2.5rem;
        }

        h2 {
            color: var(--primary-dark);
            margin-bottom: 2rem;
            font-size: 2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        h2::before {
            content: '\f004';
            font-family: 'Font Awesome 6 Free';
            color: #ef4444;
        }

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            padding: 1rem 0;
        }

        .wishlist-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid var(--gray-200);
        }

        .wishlist-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        .wishlist-card img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 1.25rem;
            transition: transform 0.3s ease;
        }

        .wishlist-card:hover img {
            transform: scale(1.05);
        }

        .wishlist-card h4 {
            margin: 0.75rem 0;
            color: var(--primary-dark);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .wishlist-card .price {
            color: var(--success-color);
            font-weight: 600;
            font-size: 1.25rem;
            margin-top: 0.5rem;
        }

        .empty {
            text-align: center;
            color: var(--gray-700);
            padding: 4rem 2rem;
            background: var(--gray-100);
            border-radius: 12px;
            margin: 2rem 0;
        }

        .empty i {
            font-size: 3rem;
            color: #ef4444;
            margin-bottom: 1rem;
        }

        .empty p {
            font-size: 1.2rem;
            margin: 0;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            background: var(--gray-200);
            color: var(--primary-dark);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            background: var(--primary-dark);
            color: white;
        }

        .remove-btn {
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .remove-btn:hover {
            background: #dc2626;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 1.5rem;
            }

            .wishlist-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1.5rem;
            }

            .wishlist-card img {
                width: 140px;
                height: 140px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('vendor.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Vendors
        </a>
        <h2>Your Wishlist</h2>
        @if(count($wishlist) > 0)
            <div class="wishlist-grid">
                @foreach($wishlist as $id => $item)
                    <div class="wishlist-card">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                        <h4>{{ $item['name'] }}</h4>
                        <div class="price">RM{{ number_format($item['price'], 2) }}</div>
                        <form method="POST" action="{{ route('wishlist.remove') }}" style="margin-top:1rem;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <button type="submit" class="remove-btn">
                                <i class="fas fa-trash"></i>
                                Remove
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty">
                <i class="fas fa-heart"></i>
                <p>Your wishlist is empty.</p>
            </div>
        @endif
    </div>
</body>
</html>
