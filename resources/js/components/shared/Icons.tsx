import type { SVGProps } from 'react';

import ArrowDownRight from '@/assets/icons/ArrowDownRight.svg?react';
import ArrowLeft from '@/assets/icons/ArrowLeft.svg?react';
import ArrowRight from '@/assets/icons/ArrowRight.svg?react';
import ArrowUpRight from '@/assets/icons/ArrowUpRight.svg?react';
import Basket from '@/assets/icons/Basket.svg?react';
import CalendarDots from '@/assets/icons/CalendarDots.svg?react';
import CaretDown from '@/assets/icons/CaretDown.svg?react';
import CaretLeft from '@/assets/icons/CaretLeft.svg?react';
import CaretRight from '@/assets/icons/CaretRight.svg?react';
import CaretUp from '@/assets/icons/CaretUp.svg?react';
import CaretUpDown from '@/assets/icons/CaretUpDown.svg?react';
import ClockCountdown from '@/assets/icons/ClockCountdown.svg?react';
import Couch from '@/assets/icons/Couch.svg?react';
import EnvelopeOpen from '@/assets/icons/EnvelopeOpen.svg?react';
import FacebookLogo from '@/assets/icons/FacebookLogo.svg?react';
import Hammer from '@/assets/icons/Hammer.svg?react';
import InstagramLogo from '@/assets/icons/InstagramLogo.svg?react';
import Leaf from '@/assets/icons/Leaf.svg?react';
import LinkedinLogo from '@/assets/icons/LinkedinLogo.svg?react';
import List from '@/assets/icons/List.svg?react';
import MagnifyingGlass from '@/assets/icons/MagnifyingGlass.svg?react';
import MapPin from '@/assets/icons/MapPin.svg?react';
import Minus from '@/assets/icons/Minus.svg?react';
import Phone from '@/assets/icons/Phone.svg?react';
import Plus from '@/assets/icons/Plus.svg?react';
import SealCheckAlt from '@/assets/icons/SealCheck-1.svg?react';
import SealCheck from '@/assets/icons/SealCheck.svg?react';
import SignOut from '@/assets/icons/SignOut.svg?react';
import SquaresFour from '@/assets/icons/SquaresFour.svg?react';
import Star from '@/assets/icons/Star.svg?react';
import StarFill from '@/assets/icons/StarFill.svg?react';
import Truck from '@/assets/icons/Truck.svg?react';
import UserFocus from '@/assets/icons/UserFocus.svg?react';
import XLogo from '@/assets/icons/XLogo.svg?react';

export const Icons = {
    ArrowDownRight: createIcon(ArrowDownRight),
    ArrowLeft: createIcon(ArrowLeft),
    ArrowRight: createIcon(ArrowRight),
    ArrowUpRight: createIcon(ArrowUpRight),
    Basket: createIcon(Basket),
    CalendarDots: createIcon(CalendarDots),
    CaretDown: createIcon(CaretDown),
    CaretLeft: createIcon(CaretLeft),
    CaretRight: createIcon(CaretRight),
    CaretUp: createIcon(CaretUp),
    CaretUpDown: createIcon(CaretUpDown),
    ClockCountdown: createIcon(ClockCountdown),
    Couch: createIcon(Couch),
    EnvelopeOpen: createIcon(EnvelopeOpen),
    FacebookLogo: createIcon(FacebookLogo),
    Hammer: createIcon(Hammer),
    InstagramLogo: createIcon(InstagramLogo),
    Leaf: createIcon(Leaf),
    LinkedinLogo: createIcon(LinkedinLogo),
    List: createIcon(List),
    MagnifyingGlass: createIcon(MagnifyingGlass),
    MapPin: createIcon(MapPin),
    Minus: createIcon(Minus),
    Phone: createIcon(Phone),
    Plus: createIcon(Plus),
    SealCheck: createIcon(SealCheck),
    SealCheckAlt: createIcon(SealCheckAlt),
    SignOut: createIcon(SignOut),
    SquaresFour: createIcon(SquaresFour),
    Star: createIcon(Star),
    StarFill: createIcon(StarFill),
    Truck: createIcon(Truck),
    UserFocus: createIcon(UserFocus),
    XLogo: createIcon(XLogo),
};

export function createIcon(Component: React.FC<SVGProps<SVGSVGElement>>) {
    return function Icon({
        size = 24,
        className = '',
        ...props
    }: SVGProps<SVGSVGElement> & { size?: number }) {
        return (
            <Component
                width={size}
                height={size}
                fill="currentColor"
                className={className}
                {...props}
            />
        );
    };
}
