import Container from '@/components/shared/container';
import type { Media } from '@/types';
import { type FC, useEffect, useRef, useState } from 'react';

type VideoPlayerProps = {
    src: string;
};

const VideoPlayer: FC<VideoPlayerProps> = ({ src }) => {
    const videoRef = useRef<HTMLVideoElement>(null);
    const [isMuted, setIsMuted] = useState(true);
    const [isPlaying, setIsPlaying] = useState(false);
    const [hasPlayed, setHasPlayed] = useState(false);

    useEffect(() => {
        const video = videoRef.current;
        if (!video) return;

        const handleEnded = (): void => setIsPlaying(false);
        const handlePlaying = (): void => setIsPlaying(true);
        video.addEventListener('ended', handleEnded);
        video.addEventListener('playing', handlePlaying);

        return () => {
            video.removeEventListener('ended', handleEnded);
            video.removeEventListener('playing', handlePlaying);
        };
    }, []);

    const toggleMute = (): void => {
        const video = videoRef.current;
        if (!video) return;
        const nextMuted = !isMuted;
        video.muted = nextMuted;
        setIsMuted(nextMuted);
    };

    const togglePlayPause = (): void => {
        const video = videoRef.current;
        if (!video) return;
        if (video.paused) {
            video.play();
            setIsPlaying(true);
            if (!hasPlayed) {
                video.muted = false;
                setIsMuted(false);
                setHasPlayed(true);
            }
        } else {
            video.pause();
            setIsPlaying(false);
        }
    };

    return (
        <>
            <video
                ref={videoRef}
                src={src}
                className="absolute top-0 left-0 h-full w-full object-cover"
                muted
                playsInline
            />
            {!isPlaying && (
                <div className="absolute inset-0 z-20 flex items-center justify-center bg-black/30">
                    <button
                        onClick={togglePlayPause}
                        className="flex h-20 w-20 cursor-pointer items-center justify-center rounded-full bg-white/20 text-white backdrop-blur-sm transition hover:bg-white/30"
                        aria-label="Phat video"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            className="h-10 w-10"
                        >
                            <path
                                fillRule="evenodd"
                                d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z"
                                clipRule="evenodd"
                            />
                        </svg>
                    </button>
                </div>
            )}
            <div className="absolute right-6 bottom-6 z-10 flex gap-2">
                <button
                    onClick={toggleMute}
                    className="flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-black/50 text-white backdrop-blur-sm transition hover:bg-black/70"
                    aria-label={isMuted ? 'Bat am thanh' : 'Tat am thanh'}
                >
                    {isMuted ? (
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            className="h-5 w-5"
                        >
                            <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 0 0 1.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06ZM17.78 9.22a.75.75 0 1 0-1.06 1.06L18.44 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 1 0 1.06-1.06L20.56 12l1.72-1.72a.75.75 0 1 0-1.06-1.06l-1.72 1.72-1.72-1.72Z" />
                        </svg>
                    ) : (
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            className="h-5 w-5"
                        >
                            <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 0 0 1.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06ZM18.584 5.106a.75.75 0 0 1 1.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 0 1-1.06-1.06 8.25 8.25 0 0 0 0-11.668.75.75 0 0 1 0-1.06Z" />
                            <path d="M15.932 7.757a.75.75 0 0 1 1.061 0 6 6 0 0 1 0 8.486.75.75 0 0 1-1.06-1.061 4.5 4.5 0 0 0 0-6.364.75.75 0 0 1 0-1.06Z" />
                        </svg>
                    )}
                </button>
                <button
                    onClick={togglePlayPause}
                    className="flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-black/50 text-white backdrop-blur-sm transition hover:bg-black/70"
                    aria-label={isPlaying ? 'Dung' : 'Phat'}
                >
                    {isPlaying ? (
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            className="h-5 w-5"
                        >
                            <path
                                fillRule="evenodd"
                                d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z"
                                clipRule="evenodd"
                            />
                        </svg>
                    ) : (
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            className="h-5 w-5 translate-x-0.5"
                        >
                            <path
                                fillRule="evenodd"
                                d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z"
                                clipRule="evenodd"
                            />
                        </svg>
                    )}
                </button>
            </div>
        </>
    );
};

type BannerSectionProps = {
    data?: { image?: Media };
};

const BannerSection: FC<BannerSectionProps> = ({ data }) => {
    const media = data?.image;

    if (!media) return null;

    const isVideo = media.mime_type?.startsWith('video/');

    return (
        <div className="relative h-[calc(100vh-var(--header-height))] w-full">
            {isVideo ? (
                <VideoPlayer src={media.url} />
            ) : (
                <img
                    src={media.url}
                    className="absolute top-0 left-0 h-full w-full object-cover"
                />
            )}
            <Container className="relative" />
        </div>
    );
};

export default BannerSection;
