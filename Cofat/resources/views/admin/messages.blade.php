@extends('admin.layouts.app')

@section('title', 'Messages')

@section('content')
@csrf
<br>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="messages-container">
    <!-- Sidebar with contacts -->
    <div class="messages-sidebar">
        <!-- Search bar -->
        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" placeholder="Search contacts..." class="search-input" value="{{ request('search') }}">
            </div>
        </div>

        <!-- Contacts list -->
        <div class="contacts-list">
            @forelse($messages as $conversation)
                <div class="contact-item {{ $loop->first ? 'active' : '' }}" 
                     data-user-id="{{ $conversation->user->id }}" 
                     data-user-name="{{ $conversation->user->name }}"
                     data-user-avatar="{{ $conversation->user->avatar ?? '' }}"
                     data-conversation-id="{{ $conversation->id }}">
                    <div class="contact-avatar">
                        @if($conversation->user->avatar)
                            <img src="{{ $conversation->user->avatar }}" alt="{{ $conversation->user->name }}" class="avatar-img">
                        @else
                            <div class="avatar-placeholder">{{ substr($conversation->user->name, 0, 1) }}</div>
                        @endif
                    </div>
                    <div class="contact-info">
                        <div class="contact-name">{{ $conversation->user->name }}</div>
                        <div class="contact-time">
                            {{ $conversation->created_at->format('H:i') }}
                            @if(!$conversation->is_replied)
                                <span class="unread-badge">New</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-contacts">No conversations found</div>
            @endforelse
        </div>
    </div>

    <!-- Main chat area -->
    <div class="chat-area">
        <!-- Chat header -->
        <div class="chat-header">
            <div class="chat-user-info">
                <div class="chat-avatar">
                    <div id="currentUserAvatar" class="avatar-placeholder">?</div>
                </div>
                <div class="chat-user-details">
                    <div class="chat-user-name" id="currentUserName">Select a user</div>
                    <div class="chat-user-status" id="currentUserStatus">Online</div>
                </div>
            </div>
            <div class="chat-actions">
                <button class="action-btn" id="deleteMessagesBtn" title="Delete conversation">
                    <i class="fas fa-trash"></i>
                </button>
                <button class="action-btn" id="refreshMessagesBtn" title="Refresh">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>

        <!-- Messages container -->
        <div class="messages-container-inner" id="messagesContainer">
            <div class="no-messages-selected">
                <i class="far fa-comment-dots"></i>
                <p>Select a conversation to start chatting</p>
            </div>
        </div>

        <!-- Message input -->
        <div class="message-input-container">
            <form id="replyForm">
                @csrf
                <input type="hidden" id="currentConversationId" name="conversation_id">
                <input type="hidden" id="currentUserId" name="user_id">
                <div class="message-input-box">
                    <input type="text" name="reply" placeholder="Type your message..." class="message-input" id="messageInput" required>
                    <button type="submit" class="send-btn" title="Send">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .messages-container {
        display: flex;
        height: calc(100vh - 70px);
        background: #ffffff; /* White background */
        border-radius: 10px; /* 10px border radius */
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb; /* Light border */
    }

    /* Sidebar Styles */
    .messages-sidebar {
        width: 300px;
        background: #1f2937; /* Dark gray background */
        color: #f9fafb; /* Light text color */
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .messages-sidebar::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset("images/wire-pattern.png") }}') center/cover;
        opacity: 0.05;
        z-index: 0;
    }

    .search-container {
        padding: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        z-index: 1;
    }

    .search-box {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-icon {
        position: absolute;
        left: 14px;
        color: #f9fafb;
        opacity: 0.8;
        font-size: 14px;
        z-index: 1;
    }

    .search-input {
        width: 100%;
        padding: 12px 16px 12px 40px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
        font-size: 14px;
        outline: none;
        transition: all 0.2s ease;
        color: #f9fafb;
        backdrop-filter: blur(5px);
    }

    .search-input:focus {
        border-color: rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
    }

    .search-input::placeholder {
        color: rgba(236, 240, 241, 0.7);
    }

    .contacts-list {
        flex: 1;
        overflow-y: auto;
        padding: 8px 0;
        position: relative;
        z-index: 1;
    }

    .no-contacts {
        padding: 40px 20px;
        text-align: center;
        color: rgba(236, 240, 241, 0.7);
        font-size: 14px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
        margin: 2px 8px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .contact-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .contact-item.active {
        background: white;
        color: #000000;
        font-weight: 600;
        box-shadow: 0 5px 20px rgba(255, 255, 255, 0.2);
    }

    .contact-item.active .contact-time,
    .contact-item.active .unread-badge {
        color: #6b7280;
    }

    .contact-item.active .unread-badge {
        background: #3b82f6;
        color: white;
    }

    .contact-avatar {
        margin-right: 14px;
        position: relative;
    }

    .avatar-img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .avatar-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 18px;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .contact-info {
        flex: 1;
        min-width: 0;
    }

    .contact-name {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 4px;
        color: inherit;
        line-height: 1.2;
    }

    .contact-time {
        font-size: 12px;
        color: rgba(236, 240, 241, 0.7);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .unread-badge {
        background: #ef4444;
        color: white;
        font-size: 10px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 20px;
        white-space: nowrap;
    }

    /* Chat Area Styles */
    .chat-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #ffffff;
        height: 100%;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .chat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    .chat-user-info {
        display: flex;
        align-items: center;
    }

    .chat-avatar {
        margin-right: 14px;
    }

    .chat-user-details {
        display: flex;
        flex-direction: column;
    }

    .chat-user-name {
        font-weight: 600;
        font-size: 16px;
        color: #111827;
        line-height: 1.2;
    }

    .chat-user-status {
        font-size: 12px;
        color: #10b981;
        margin-top: 2px;
    }

    .chat-actions {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        width: 40px;
        height: 40px;
        border: none;
        background: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #6b7280;
    }

    .action-btn:hover {
        background: #f3f4f6;
        color: #111827;
        border-color: #9ca3af;
        transform: translateY(-1px);
    }

    .action-btn:active {
        transform: translateY(0);
    }

    .messages-container-inner {
        flex: 1;
        padding: 24px;
        overflow-y: auto;
        background: #f9fafb;
        position: relative;
    }

    .no-messages-selected {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #6b7280;
    }

    .no-messages-selected i {
        font-size: 64px;
        margin-bottom: 20px;
        color: #d1d5db;
    }

    .no-messages-selected p {
        font-size: 16px;
        margin: 0;
        font-weight: 500;
    }

    .message {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        animation: slideInMessage 0.3s ease-out;
    }

    .message.sent {
        align-items: flex-end;
    }

    .message.received {
        align-items: flex-start;
    }

    .message-content {
        max-width: 75%;
        padding: 14px 18px;
        border-radius: 20px;
        font-size: 14px;
        line-height: 1.5;
        word-wrap: break-word;
        position: relative;
    }

    .message.sent .message-content {
        background: linear-gradient(135deg,rgb(0, 0, 0),rgb(255, 255, 255));
        color: white;
        border-bottom-right-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .message.received .message-content {
        background: #ffffff;
        color: #111827;
        border: 1px solid #e5e7eb;
        border-bottom-left-radius: 8px;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .message-time {
        font-size: 11px;
        color: #6b7280;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }

    .message.sent .message-time {
        justify-content: flex-end;
    }

    .message-status {
        font-size: 10px;
        color: #10b981;
    }

    .message-input-container {
        padding: 20px 24px;
        border-top: 1px solid #e5e7eb;
        background: #ffffff;
        display: none;
    }

    .message-input-box {
        display: flex;
        align-items: center;
        background: #f9fafb;
        border: 1px solid #d1d5db;
        border-radius: 20px;
        padding: 8px;
        transition: all 0.2s ease;
    }

    .message-input-box:focus-within {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        background: #ffffff;
    }

    .message-input {
        flex: 1;
        border: none;
        background: transparent;
        outline: none;
        font-size: 14px;
        padding: 10px 12px;
        color: #111827;
        line-height: 1.4;
    }

    .message-input::placeholder {
        color: #9ca3af;
    }

    .send-btn {
        width: 36px;
        height: 36px;
        border: none;
        background: #3b82f6;
        color: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-left: 8px;
    }

    .send-btn:hover {
        background: #2563eb;
        transform: scale(1.05);
    }

    .send-btn:active {
        transform: scale(0.95);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .messages-container {
            height: calc(100vh - 60px);
            border-radius: 0;
        }
        
        .messages-sidebar {
            width: 100%;
            position: absolute;
            z-index: 10;
            height: 100%;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-radius: 0;
        }
        
        .messages-sidebar.open {
            transform: translateX(0);
        }
        
        .chat-area {
            width: 100%;
            border-radius: 0;
        }
        
        .message-content {
            max-width: 85%;
        }
        
        .mobile-menu-btn {
            display: flex !important;
        }
        
        .chat-header {
            padding: 16px 20px;
        }
        
        .messages-container-inner {
            padding: 16px;
        }
        
        .message-input-container {
            padding: 16px 20px;
        }
    }

    /* Animations */
    @keyframes slideInMessage {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Scrollbar Styling */
    .contacts-list::-webkit-scrollbar {
        width: 6px;
    }

    .contacts-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .contacts-list::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .contacts-list::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Typing Indicator */
    .typing-indicator {
        display: flex;
        margin-bottom: 15px;
    }

    .typing-dots {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
    }

    .typing-dot {
        width: 8px;
        height: 8px;
        background: #6b7280;
        border-radius: 50%;
        margin: 0 2px;
        animation: typingAnimation 1.4s infinite ease-in-out;
    }

    .typing-dot:nth-child(1) {
        animation-delay: 0s;
    }

    .typing-dot:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typingAnimation {
        0%, 60%, 100% {
            transform: translateY(0);
        }
        30% {
            transform: translateY(-5px);
        }
    }

    /* Status Messages */
    .message-success {
        background: #10b981;
        color: white;
        padding: 10px 15px;
        border-radius: 4px;
        margin-bottom: 15px;
        font-size: 14px;
        display: flex;
        align-items: center;
    }

    .message-success i {
        margin-right: 8px;
    }

    .message-error {
        background: #ef4444;
        color: white;
        padding: 10px 15px;
        border-radius: 4px;
        margin-bottom: 15px;
        font-size: 14px;
        display: flex;
        align-items: center;
    }

    .message-error i {
        margin-right: 8px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const searchInput = document.getElementById('searchInput');
        const contactsList = document.querySelector('.contacts-list');
        const messagesContainer = document.getElementById('messagesContainer');
        const currentUserAvatar = document.getElementById('currentUserAvatar');
        const currentUserName = document.getElementById('currentUserName');
        const currentUserStatus = document.getElementById('currentUserStatus');
        const currentUserId = document.getElementById('currentUserId');
        const currentConversationId = document.getElementById('currentConversationId');
        const messageInputContainer = document.querySelector('.message-input-container');
        const replyForm = document.getElementById('replyForm');
        const messageInput = document.getElementById('messageInput');
        const deleteMessagesBtn = document.getElementById('deleteMessagesBtn');
        const refreshMessagesBtn = document.getElementById('refreshMessagesBtn');
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const messagesSidebar = document.querySelector('.messages-sidebar');

        let currentSelectedUserId = null;
        let currentSelectedConversationId = null;
        let isLoading = false;
        let lastMessageTimestamp = null; // Track last message timestamp
        let refreshInterval = null; // Store the interval reference

        // Auto-scroll to bottom of messages
        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Create avatar placeholder
        function createAvatarPlaceholder(name) {
            return name ? name.charAt(0).toUpperCase() : '?';
        }

        // Show typing indicator
        function showTypingIndicator() {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'typing-indicator';
            typingDiv.id = 'typingIndicator';
            typingDiv.innerHTML = `
                <div class="typing-dots">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            `;
            messagesContainer.appendChild(typingDiv);
            scrollToBottom();
        }

        // Hide typing indicator
        function hideTypingIndicator() {
            const typingIndicator = document.getElementById('typingIndicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }

        // Show success message
        function showSuccessMessage(message) {
            const successDiv = document.createElement('div');
            successDiv.className = 'message-success';
            successDiv.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
            messagesContainer.appendChild(successDiv);
            
            setTimeout(() => {
                successDiv.remove();
            }, 3000);
        }

        // Show error message
        function showErrorMessage(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'message-error';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
            messagesContainer.appendChild(errorDiv);
            
            setTimeout(() => {
                errorDiv.remove();
            }, 5000);
        }

        // Format message time
        function formatMessageTime(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffInHours = (now - date) / (1000 * 60 * 60);
            
            if (diffInHours < 24) {
                return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            } else if (diffInHours < 48) {
                return 'Yesterday ' + date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            } else {
                return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            }
        }

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            if (!text) return '';
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.toString().replace(/[&<>"']/g, function(m) { return map[m]; });
        }

        // Load messages for a user
        function loadUserMessages(userId, preserveNewMessages = false) {
            if (isLoading) return;
            
            isLoading = true;
            messagesContainer.classList.add('loading');
            
            // Store current scroll position
            const scrollBefore = messagesContainer.scrollTop;
            const isNearBottom = messagesContainer.scrollHeight - messagesContainer.scrollTop - messagesContainer.clientHeight < 50;
            
            fetch(`/admin/messages/user/${userId}${lastMessageTimestamp ? `?since=${lastMessageTimestamp}` : ''}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Only clear messages if not preserving new ones
                    if (!preserveNewMessages) {
                        messagesContainer.innerHTML = '';
                    }
                    
                    if (data.messages.length === 0) {
                        if (!preserveNewMessages) {
                            messagesContainer.innerHTML = `
                                <div class="no-messages">
                                    <i class="far fa-comment-alt"></i>
                                    <p>No messages yet</p>
                                </div>
                            `;
                        }
                        return;
                    }
                    
                    // Sort messages by date (oldest first)
                    const sortedMessages = data.messages.sort((a, b) => 
                        new Date(a.created_at) - new Date(b.created_at));
                    
                    // Update last message timestamp
                    lastMessageTimestamp = sortedMessages[sortedMessages.length - 1].created_at;
                    
                    // Display messages
                    sortedMessages.forEach(message => {
                        const isAdmin = message.admin_id !== null;
                        const messageTime = formatMessageTime(message.created_at);
                        
                        const messageElement = document.createElement('div');
                        messageElement.className = `message ${isAdmin ? 'sent' : 'received'}`;
                        messageElement.innerHTML = `
                            <div class="message-content">${escapeHtml(isAdmin ? message.reply : message.message)}</div>
                            <div class="message-time">
                                ${messageTime}
                                ${isAdmin ? '<i class="fas fa-check-double message-status"></i>' : ''}
                            </div>
                        `;
                        
                        messagesContainer.appendChild(messageElement);
                    });
                    
                    // Restore scroll position if we weren't near bottom
                    if (!isNearBottom && preserveNewMessages) {
                        messagesContainer.scrollTop = scrollBefore;
                    } else {
                        scrollToBottom();
                    }
                    
                    // Mark as read if there are unread messages
                    if (data.has_unread) {
                        markMessagesAsRead(userId);
                    }
                })
                .catch(error => {
                    console.error('Error loading messages:', error);
                    if (!preserveNewMessages) {
                        showErrorMessage('Failed to load messages. Please try again.');
                        messagesContainer.innerHTML = `
                            <div class="no-messages">
                                <i class="fas fa-exclamation-triangle"></i>
                                <p>Error loading messages</p>
                            </div>
                        `;
                    }
                })
                .finally(() => {
                    isLoading = false;
                    messagesContainer.classList.remove('loading');
                });
        }

        // Mark messages as read
        function markMessagesAsRead(userId) {
            fetch(`/admin/messages/mark-as-read/${userId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network error');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Remove unread badges from the contact item
                    const activeContact = document.querySelector('.contact-item.active');
                    if (activeContact) {
                        const unreadBadge = activeContact.querySelector('.unread-badge');
                        if (unreadBadge) {
                            unreadBadge.remove();
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error marking messages as read:', error);
            });
        }

        // Handle contact selection
        function selectContact(contactItem) {
            const userId = contactItem.dataset.userId;
            const userName = contactItem.dataset.userName;
            const userAvatar = contactItem.dataset.userAvatar;
            const conversationId = contactItem.dataset.conversationId;
            
            // Clear any existing refresh interval
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }
            
            // Reset last message timestamp
            lastMessageTimestamp = null;
            
            // Update UI
            document.querySelectorAll('.contact-item').forEach(contact => {
                contact.classList.remove('active');
            });
            contactItem.classList.add('active');
            
            // Update avatar
            currentUserAvatar.innerHTML = '';
            if (userAvatar) {
                const img = document.createElement('img');
                img.src = userAvatar;
                img.className = 'avatar-img';
                img.alt = userName;
                currentUserAvatar.appendChild(img);
            } else {
                currentUserAvatar.innerHTML = createAvatarPlaceholder(userName);
                currentUserAvatar.className = 'avatar-placeholder';
            }
            
            currentUserName.textContent = userName;
            currentUserStatus.textContent = 'Online';
            currentUserId.value = userId;
            currentConversationId.value = conversationId;
            currentSelectedUserId = userId;
            currentSelectedConversationId = conversationId;
            
            // Show message input and action buttons
            messageInputContainer.style.display = 'block';
            deleteMessagesBtn.style.display = 'flex';
            refreshMessagesBtn.style.display = 'flex';
            
            // Load messages
            loadUserMessages(userId);
            
            // Start new refresh interval
            refreshInterval = setInterval(() => {
                if (currentSelectedUserId && !isLoading) {
                    loadUserMessages(currentSelectedUserId, true); // Preserve new messages
                }
            }, 30000);
            
            // Close mobile sidebar
            if (window.innerWidth <= 768) {
                messagesSidebar.classList.remove('open');
            }
        }

        // Handle contact click events
        document.querySelectorAll('.contact-item').forEach(item => {
            item.addEventListener('click', function() {
                selectContact(this);
            });
        });

        // Handle search
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            document.querySelectorAll('.contact-item').forEach(item => {
                const name = item.querySelector('.contact-name').textContent.toLowerCase();
                const isVisible = name.includes(searchTerm);
                item.style.display = isVisible ? 'flex' : 'none';
            });
        });

        // Handle form submission
        replyForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (isLoading) return;
            
            const formData = new FormData(this);
            const userId = currentUserId.value;
            const messageText = messageInput.value.trim();
            const conversationId = currentConversationId.value;
            
            if (!messageText || !userId || !conversationId) {
                messageInput.focus();
                showErrorMessage('Please enter a message and select a user');
                return;
            }
            
            // Show typing indicator
            showTypingIndicator();
            
            // Disable form
            messageInput.disabled = true;
            replyForm.querySelector('.send-btn').disabled = true;
            
            fetch(`/admin/messages/${conversationId}/reply`, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Clear input
                    messageInput.value = '';
                    
                    // Show success message
                    showSuccessMessage('Message sent successfully');
                    
                    // Create and display the new message immediately
                    const now = new Date();
                    const messageTime = formatMessageTime(now);
                    const messageElement = document.createElement('div');
                    messageElement.className = 'message sent';
                    messageElement.innerHTML = `
                        <div class="message-content">${escapeHtml(messageText)}</div>
                        <div class="message-time">
                            ${messageTime}
                            <i class="fas fa-check-double message-status"></i>
                        </div>
                    `;
                    messagesContainer.appendChild(messageElement);
                    scrollToBottom();
                    
                    // Update the contact list to show replied status
                    const activeContact = document.querySelector('.contact-item.active');
                    if (activeContact) {
                        const timeDiv = activeContact.querySelector('.contact-time');
                        if (timeDiv) {
                            // Update timestamp
                            timeDiv.innerHTML = formatMessageTime(now);
                            
                            // Remove unread badge if exists
                            const unreadBadge = timeDiv.querySelector('.unread-badge');
                            if (unreadBadge) {
                                unreadBadge.remove();
                            }
                        }
                    }
                    
                    // Update last message timestamp
                    lastMessageTimestamp = now.toISOString();
                } else {
                    throw new Error(data.message || 'Error sending message');
                }
            })
            .catch(error => {
                console.error('Error sending reply:', error);
                showErrorMessage(error.message || 'Failed to send message. Please try again.');
            })
            .finally(() => {
                hideTypingIndicator();
                // Re-enable form
                messageInput.disabled = false;
                replyForm.querySelector('.send-btn').disabled = false;
                messageInput.focus();
            });
        });

        // Handle delete messages
        deleteMessagesBtn.addEventListener('click', function() {
            if (!currentSelectedUserId) return;
            if (!confirm('Are you sure you want to delete all messages from this user?')) return;
            
            fetch(`/admin/messages/user/${currentSelectedUserId}/delete-all`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showSuccessMessage('All messages from this user have been deleted');
                    // Reload page to update contacts list
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    throw new Error(data.message || 'Error deleting messages');
                }
            })
            .catch(error => {
                console.error('Error deleting messages:', error);
                showErrorMessage('Failed to delete messages. Please try again.');
            });
        });

        // Handle refresh messages
        refreshMessagesBtn.addEventListener('click', function() {
            if (currentSelectedUserId) {
                loadUserMessages(currentSelectedUserId);
                showSuccessMessage('Messages refreshed');
            }
        });

        // Auto-select first contact if exists and none is selected
        const firstContact = document.querySelector('.contact-item:not(.no-contacts)');
        if (firstContact && !document.querySelector('.contact-item.active')) {
            selectContact(firstContact);
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                messagesSidebar.classList.remove('open');
            }
        });

        // Handle Enter key in message input
        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                replyForm.dispatchEvent(new Event('submit'));
            }
        });

        // Auto-focus message input when contact is selected
        messageInput.addEventListener('focus', function() {
            scrollToBottom();
        });

        // Clean up interval when leaving the page
        window.addEventListener('beforeunload', function() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }
        });
    });
</script>
@endsection