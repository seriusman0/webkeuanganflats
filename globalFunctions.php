<?php

function sub_status($stat)
{
    switch ($stat) {
        case 0: {
                return "Draft";
                break;
            }
        case 1: {
                return "Not Verified by Shepherd";
                break;
            }
        case 2: {
                return "Verified By Shepherd";
                break;
            }
        case 3: {
                return "Proccessed By Biro";
                break;
            }
        case 4: {
                return "Verified";
                break;
            }
        case 5: {
                return "Decline";
                break;
            }
        default: {
                return "Unknown Status";
                break;
            }
    }
}
